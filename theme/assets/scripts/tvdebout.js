(function($) {

var TvDebout = function()
{
var that = this;
this.state = false;
this.checkSource.timeout = 0;
this.checkSource.timer = 60000;
this.player = videojs('tvdebout');
this.sources = this.player.options_.sources;
this.statusSetup();
this.player.on('stalled', function(){ that.stalled(this); });
this.player.on('error', function(){ that.error(this); });
this.player.on('ended', function(){ that.ended(); });
this.player.on('canplay', function(){ that.canplay(); });
this.player.on('loadedmetadata', function(){ that.canplay(); });
this.checkSource();
};

TvDebout.prototype.checkSource = function()
{
var that = this;

	if(typeof arguments[0] === "number" && arguments[0] > 0)
	{
	this.checkSource.timer = arguments[0];
	}

	if(this.checkSource.timer > 60000)
	{
	this.checkSource.timer = 60000;
	}

clearTimeout(this.checkSource.timeout);

this.checkSource.timeout = setTimeout(function(){ that.checkSource(); }, this.checkSource.timer);

this.checkSource.timer *= 2;

	var source = $.get(this.sources[0].src+"?"+new Date().getTime())
	.error(function()
	{
	that.error();
	})
	.success(function()
	{
		if(that.state === false)
		{
		that.reload();
		}
	});
};

TvDebout.prototype.error = function(error)
{
	if(this.state === true)
	{
	this.hide();
	this.checkSource(2000);
	}
};

TvDebout.prototype.stalled = function(stalled)
{
};

TvDebout.prototype.canplay = function()
{
	if(this.state === false)
	{
	this.show();
	}
};

TvDebout.prototype.ended = function()
{
	if(this.state === true)
	{
	this.hide();
	this.reload();
	}
};

TvDebout.prototype.reload = function()
{
this.player.pause();
this.player.currentTime(0);
this.player.src(this.sources);
};

TvDebout.prototype.hide = function()
{
$(".video-section .live").addClass("hide-live");
this.state = false;
};

TvDebout.prototype.show = function()
{
$(".video-section .live").removeClass("hide-live");
this.state = true;
};

TvDebout.prototype.statusSetup = function()
{
var status = $("<div></div>");
status.attr("class", "vjs-status");
status.text("live");
this.statusElem = status;
$('#tvdebout .vjs-big-play-button').append(status);
};

new TvDebout();

})(jQuery);
