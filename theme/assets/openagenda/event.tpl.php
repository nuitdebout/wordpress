<a href="{BackLink}">{BackLabel}</a>
<h1>{Title}</h1>
<div class="event-content">

  <p class="short-description">{Description}</p>

  <div class="share">
{block:FacebookShareUrl}
    <a href="{FacebookShareUrl}"><i class="fa fa-facebook-official"></i></a>
{/block:FacebookShareUrl}
{block:TwitterShareUrl}
    <a href="{TwitterShareUrl}"><i class="fa fa-twitter-square"></i></a>
{/block:TwitterShareUrl}
{block:GoogleShareUrl}
    <a href="{GoogleShareUrl}"><i class="fa fa-google-plus-square"></i></a>
{/block:GoogleShareUrl}
{block:LinkedInShareUrl}
    <a href="{LinkedInShareUrl}"><i class="fa fa-linkedin-square"></i></a>
{/block:LinkedInShareUrl}
{block:TumblrShareUrl}
    <a href="{TumblrShareUrl}"><i class="fa fa-tumblr-square"></i></a>
{/block:TumblrShareUrl}
{block:PinterestShareUrl}
    <a href="{PinterestShareUrl}"><i class="fa fa-pinterest-square"></i></a>
{/block:PinterestShareUrl}
{block:EmailShareUrl}
    <a target="_blank" href="{EmailShareUrl}"><i class="fa fa-envelope"></i></a>
{/block:EmailShareUrl}
  </div>

{block:Conditions}
  <div class="conditions">
    <p>{Conditions}</p>
  </div>
{/block:Conditions}
{block:TicketUrl}
  <div class="ticket-link">
    <a href="{TicketUrl}">{TicketUrl}</a>
  </div>
{/block:TicketUrl}

  {block:ImageUrl}
  <img class="img-responsive" src="{ImageUrl}" alt="{Title}"/>
  {/block:ImageUrl}

  <div class="description">
  {FreeText}
  </div>

  <div class="location">
    <a href="{LocationLink}">{LocationName}</a>
    <p>{Address}</p>
  </div>

  <section class="dates">
    <ul>
{block:Dates}
      <li>
        {Date}
{block:Timings}
  - {Start} > {End}
{/block:Timings}
      </li>
{/block:Dates}
    </ul>
  </section>

</div>