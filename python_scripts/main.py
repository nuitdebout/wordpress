#!/bin/env/python3
"""
Exports all doleances as result.json from the wiki.

Format is [{'date': [dol1, dol2]}]
"""

import re
import json
import requests
import datetime
import locale
import time
from bs4 import BeautifulSoup as BS

db = {}


locale.setlocale(locale.LC_TIME, 'fr_fr')


if __name__ == '__main__':

    rep = requests.get('https://wiki.nuitdebout.fr/wiki/Villes/Paris/Cahiers_de_dol%C3%A9ances_et_d%27exigences/Dol%C3%A9ances')

    soup = BS(rep.content,  "html.parser")
    date = soup.find(class_='navbox collapsible noprint uncollapsed')
    links = date.find_all('tr')[1].find_all('a')

    for link in links:
        url = 'https://wiki.nuitdebout.fr' + link['href']


        # url = 'https://wiki.nuitdebout.fr/wiki/Villes/Paris/Cahiers_de_dol%C3%A9ances_et_d%27exigences/Dol%C3%A9ances/Dol%C3%A9ances_du_44_mars_(13_avril_2016)'

        rep = requests.get(url)
        soup = BS(rep.content, "html.parser")

        title = soup.find(class_='mw-headline')

        # filter links that are not doleance links
        if title and url not in [
            'https://wiki.nuitdebout.fr/wiki/Villes/Paris/Cahiers_de_dol%C3%A9ances_et_d%27exigences',]:
            print(url)
            title = title.text
            head = title[:21]
            date = title[-14:-1]
            date = datetime.datetime.strptime(date.lstrip('(').replace('1er', '1'), '%d %B %Y')
            date = datetime.datetime.strftime(date, '%Y-%m-%d 00:00:00')

            text = soup.find(id='mw-content-text').text

            dols = re.finditer(r'\d+\s{0,1}[–|-](.*?)(?=\n\s*\d+\s{0,1}[–|-])', text, re.DOTALL|re.UNICODE)
            dols = [i.groups()[0].strip() for i in dols]

            nb_dols = len(dols)
            last_dol = re.findall(str(nb_dols+1) + r'\s{0,1}[–|-](.*?)v\xa0· mDoléances', text, re.DOTALL|re.UNICODE)

            last_dol = last_dol[0].strip()
            dols.append(last_dol)

            db[date] = [dol.strip() for dol in dols]

            for dol in dols:
                time.sleep(0.1)
                print(dol)

    with open('result.json', 'w') as f:
        json.dump(db, f)