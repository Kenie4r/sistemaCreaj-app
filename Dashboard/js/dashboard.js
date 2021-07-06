// Variables
$font-family: "Open Sans", Helvetica, Arial, sans-serif

// Mixins
=absolute($top, $left, $right, $bottom)
	position: absolute
	top: $top
	left: $left
	right: $right
	bottom: $bottom

=translate($x,$y)
	-webkit-transform: translate($x,$y)
	-webkit-transform: translate3d($x,$y,0)
	-ms-transform: translate($x,$y)
	-ms-transform: translate3d($x,$y,0)
	transform: translate($x,$y)
	transform: translate3d($x,$y,0)

// Colors
$background-light: #F3F4F8
$background-dark: #2F3032
$border-light: darken($background-light, 2%)
$border-dark: darken($background-dark, 2%)
$primary-color: #004983

// Base
*
	font-family: $font-family

html
	height: 100%
	font-size: 16px

body
	height: 100%
	background: $background-light

header
	position: fixed
	top: 0
	left: 0
	right: 0
	height: 60px
	background: white
	box-shadow: inset 0 -1px 0 0 $border-light

sidebar
	position: fixed
	top: 0
	left: 0
	bottom: 0
	width: 180px
	background: $primary-color

	.brand
		padding: 20px 20px 5px
		
		a
			display: block
			width: 70px
			height: 70px
			margin: 0 auto
			padding: 0
			font:
				size: 2.5rem
				weight: 300
				style: italic
			text:
				align: center
				decoration: none !important
			line-height: 62px
			color: #7a9ab6
			background: #003b69
			border-radius: 100%
	
	button.app-menu__button
		display: block
		display: flex
		flex:
			direction: column
		align-items: center
		justify-content: center
		width: 50px
		height: 50px
		margin: 0 auto 15px
		padding: 14px
		background: none
		border: none
		border-radius: 100%
		outline: none !important
  
		// CSS States
		&:hover
			// ..for default state only
			&:not(.is-expanded)
				.app-icon__component:first-child
					animation: moshpit-1 0.25s ease-in-out infinite alternate 

				.app-icon__component:nth-child(3)
					animation: moshpit-2 0.25s ease-in-out infinite alternate

				.app-icon__component:nth-child(7)
					animation: moshpit-3 0.25s ease-in-out infinite alternate

				.app-icon__component:nth-child(9)
					animation: moshpit-4 0.25s ease-in-out infinite alternate      

		.app-icon
			position: relative
			display: block
			width: 22px
			height: 22px
			margin: 0 0 0 0px
			padding: 0
			background: none
			border: none 

			// Default Button State
			.app-icon__component
				display: inline-block
				position: absolute
				width: 4px
				height: 4px
				background: #7a9ab6
				border-radius: 100%
				transition: transform 0.2s ease-out, background 0.2s ease-out

				&:first-child
					top: 2px
					left: 2px


				&:nth-child(2)
					top: 2px
					left: 50%
					+translate(-50%, 0)

				&:nth-child(3)
					top: 2px
					right: 2px

				&:nth-child(4)
					top: 50%
					left: 2px
					+translate(0, -50%)

				&:nth-child(5)
					top: 50%
					left: 50%
					+translate(-50%, -50%)

				&:nth-child(6)
					top: 50%
					right: 2px
					+translate(0, -50%)

				&:nth-child(7)
					bottom: 2px
					left: 2px

				&:nth-child(8)
					bottom: 2px
					left: 50%
					+translate(-50%,0)

				&:nth-child(9)
					bottom: 2px
					right: 2px  

		// State Based Class assigned on click
		&.is-expanded
			.app-icon__component
				background: transparentize(#b9ccdc, 0.2)

				&:first-child
					// +translate(-2px, -2px)
					transform: translate(3px, 3px) scale(1)

				&:nth-child(2)
					transform: translate(calc(-50% - 9px), -1px) scale(1)

				&:nth-child(3)
					// +translate(2px, -2px)
					transform: translate(-3px, 3px) scale(1)

				&:nth-child(4)
					transform: translate(-2px, calc(-50% + 8px)) scale(1)

				&:nth-child(5)
					transform: translate(-50%, -50%) scale(1)

				&:nth-child(6)
					transform: translate(2px, calc(-50% - 8px)) scale(1)

				&:nth-child(7)
					// +translate(-2px, 2px)
					transform: translate(3px, -3px) scale(1)

				&:nth-child(8)
					transform: translate(calc(-50% + 9px), 1px) scale(1)

				&:nth-child(9)
					// +translate(2px, 2px)
					transform: translate(-3px, -3px) scale(1)

	.menu-collapse
		display: block
		width: 100%
		padding: 6px 20px
		font:
			size: 0.8125rem
			weight: 700
		text:
			align: left
		color: #012c4e
		background: none
		border: none
		outline: none !important
	
		// States
		&.collapsed
			.caret
				transform: rotate(-90deg)
	
		.caret
			margin-right: 6px
			transform-origin: center center
			transition: transform 0.2s ease-in
	
	nav
		max-height: calc(100vh - 145px)
		overflow: auto
	
		&::-webkit-scrollbar
			width: 6px

		/* Track */
		&::-webkit-scrollbar-track
			border-radius: 10px

		/* Handle */
		&::-webkit-scrollbar-thumb
			border-radius: 10px
			background: $primary-color
	
	ul.nav
		margin-bottom: 25px
	
		li
			a
				display: block
				position: relative
				padding-left: 50px
				font:
					size: 0.875rem
					weight: 400
				text:
					transform: uppercase
					decoration: none
				letter-spacing: 0.2px
				color: #467193
		
				&:hover
					color: transparentize(#b9ccdc, 0.2)
					background: none
		
				&:focus
					background: none
		
				svg
					+absolute(50%,15px,null,null)
					width: 20px
					height: 20px
					fill: currentColor
					+translate(0,-50%)
		
				.lnr-star
					margin-top: -1px		/* adjuster */
		
				span
					display: block
					+absolute(50%,15px,null,null)
					width: 20px
					height: 20px
					margin-left: -1px		/* adjuster */
					font:
						size: 1.5rem
						weight: 300
					text:
						align: center
					line-height: 1.1rem
					+translate(0,-50%)
		
		li.active
			a
				color: transparentize(#b9ccdc, 0.2)
				background: transparentize(#b9ccdc, 0.9)
	
// Animation keyframes
@keyframes moshpit-1
	from
		+translate(0,0)
	to
		+translate(-2px,-2px)
    
@keyframes moshpit-2
	from
		+translate(0,0)
	to
		+translate(2px,-2px)  
    
@keyframes moshpit-3
	from
		+translate(0,0)
	to
		+translate(-2px,2px) 
    
@keyframes moshpit-4
	from
		+translate(0,0)
	to
		+translate(2px,2px) 
		
	
        $('button').on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('is-expanded');
          })