(function($) {

var TvDebout = function()
{
var that = this;
this._reloadTimer = null;
this.player = videojs('tvdebout');
this.player.on('stalled', function(){ that.stalled(); });
this.player.on('error', function(){ that.stalled(); });
this.player.on('ended', function(){ that.ended(); });
this.player.on('canplay', function(){ that.canplay(); });
};

TvDebout.prototype.stalled = function()
{

	if(this.player.readyState() != 0)
	{
	clearTimeout(this._reloadTimer);
	return 0;
	}
var that = this;
this.hide();
this._reloadTimer = setTimeout(function(){ that.reload(); }, 15000);
};

TvDebout.prototype.canplay = function()
{
clearTimeout(this._reloadTimer);
this.show();
};

TvDebout.prototype.ended = function()
{
this.hide();
this.reload();
};

TvDebout.prototype.reload = function()
{
this.player.src(this.player.options_.sources);
};

TvDebout.prototype.hide = function()
{
$(".tvdebout-container .live").addClass("hide-live");
};

TvDebout.prototype.show = function()
{
$(".tvdebout-container .live").removeClass("hide-live");
};

new TvDebout();

})(jQuery);
