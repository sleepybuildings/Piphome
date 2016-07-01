/**
 * Created by thomassmit on 14/05/16.
 */

(function()
{

	$.fn.pageSwipe = function()
	{
		var swiper = {

			animateOptions: {
				duration: 200,
				queue: false
			},
			threshold: 200,
			ignore: 10,
			pageWidth: 0,
			moving: false,

			pages: {
				active: null,
				left:   null,
				right:  null,
			},


			position: {
				start:   0,
				current: 0
			},


			init: function(activePage)
			{
				this.selectPages(activePage);
			},


			selectPages: function(newActivePage)
			{
				if(!newActivePage.size())
				{
					this.resetMove();
					return;
				}

				this.pages.active = newActivePage;
				this.pages.left = newActivePage.prev();
				this.pages.right = newActivePage.next();
			},


			resetMove: function()
			{
				this.setPagePosition(0, true);
			},


			gotoPage: function()
			{

			},


			finishMove: function()
			{

				if(Math.abs(this.position.current - this.position.start) < this.threshold)
				{
					this.resetMove();
					return;
				}

				var animate = true;

				if(this.position.current > this.position.start)
				{
					if(animate)
					{
						this.pages.active.animate({left: this.pageWidth}, this.animateOptions);
						this.pages.left.animate({left: 0}, this.animateOptions);

					} else {

						this.pages.active.css('left', this.pageWidth);
						this.pages.left.css('left', 0);
					}

					this.selectPages(this.pages.left);

				} else {

					if(animate)
					{
						this.pages.active.animate({left: -this.pageWidth}, this.animateOptions);
						this.pages.right.animate({left: 0}, this.animateOptions);
					} else {
						this.pages.active.css('left', -this.pageWidth);
						this.pages.right.css('left', 0);
					}
					this.selectPages(this.pages.right);
				}
			},


			movePage: function(pointerPosition)
			{
				this.position.current = pointerPosition;

				if(Math.abs(this.position.current - this.position.start) < this.ignore)
					return; // Negeer te kleine swipes

				var newPosition = 0;
				if(this.position.current > this.position.start)
					newPosition = this.position.current - this.position.start;
				else
					newPosition = -(this.position.start - this.position.current);

				this.setPagePosition(newPosition);
			},


			setPagePosition: function(left, animate)
			{
				if(animate)
				{
					this.pages.active.animate({left: left}, this.animateOptions);
					this.pages.right.animate({left: left + this.pageWidth}, this.animateOptions);
					this.pages.left.animate({left: left - this.pageWidth}, this.animateOptions);
				} else {
					this.pages.active.css('left', left);
					this.pages.right.css('left', left + this.pageWidth);
					this.pages.left.css('left', left - this.pageWidth);
				}
			},


			onPageMouseDown: function(event)
			{
				if(event.target.className === 'rangeslider__handle'  || (event.target.type && (
						event.target.type == 'range' || event.target.type == 'submit' || event.target.type == 'button')
				))
				{
					return;
				}

				this.moving = true;
				this.position.start = this.position.current = event.clientX;
			},


			onPageMouseUp: function(event)
			{
				if(this.moving)
				{
					this.moving = false;
					this.position.current = event.clientX;
					this.finishMove();
				}
			},


			onPageMouseMove: function(event)
			{
				if(this.moving)
					this.movePage(event.clientX);
			},
		};


		var pageLeft = 0;
		$(this).find('.page').each(function()
		{
			if(swiper.pageWidth == 0)
				swiper.pageWidth = $(this).width();

			$(this)
				.css('left', pageLeft)
				.bind('mousedown', function(event){ swiper.onPageMouseDown(event) })
				.bind('mouseup',   function(event){ swiper.onPageMouseUp(event)   })
				.bind('mousemove', function(event){ swiper.onPageMouseMove(event) });

			pageLeft += swiper.pageWidth;
		});

		swiper.init($(this).find('.page:first'));
	};


	$(document).ready(function()
	{
		$('#pages').pageSwipe();
	})

})();