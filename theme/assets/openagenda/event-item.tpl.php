<article class="row">
  <section>
    <a class="event-card" href="{Link}">
{block:ImageUrl}
      <div class="event-img">
        <img class="img-responsive" src="{ImageUrl}" alt="{Title}"/>
      </div>
{/block:ImageUrl}
      {Favorite}
      <h3 class="event-title">{Title}</h3>
      <div class="event-text">
        <p>{Description}</p>
        <ul class="metas">
          <li>{LocationName}<!-- or City --></li>
          <li>{DateRange}</li>
        </ul>
      </div>
    </a>
  </section>
</article>