<?php
/**
 * Template Name: Periodic Table
 */

get_header(); ?>

<script type="text/javascript">
  // Group switching
  jQuery("#cg-all").addClass("pt-active");
  jQuery("button#pt-reset, .pt-element-desc div").hide();

  jQuery(".pt-filters .pt-element").click(function() {
	jQuery(this).addClass("pt-active");
	jQuery(this).siblings().each(function(){
	  jQuery(this).removeClass("pt-active");
	});
  });

  /* Hide intro content */
  jQuery(".pt-hide-content, .pt-toggle-hide-link").hide();
  jQuery(".pt-toggle-link").click(function() {
	jQuery(".pt-hide-content").slideDown();
	jQuery(this).hide();
	jQuery(".pt-toggle-hide-link").show();
  });
  jQuery(".pt-toggle-hide-link").click(function() {
	jQuery(".pt-hide-content").slideUp();
	jQuery(this).hide();
	jQuery(".pt-toggle-link").show();
  });

  // Key drop downs
  jQuery("#cg-metals").click(function() {
	jQuery(".pt-filter-metal").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-metal").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-metal").addClass("pt-active");
	// jQuery(".pt-table .pt-element").not(".pt-table .pt-alkali, .pt-table .pt-alkaline, .pt-table .pt-transition, .pt-table .pt-basic, .pt-table .pt-post-transition, .pt-table .pt-metalloids, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-not-selected");
	jQuery(".pt-table .pt-element").not(".pt-table .pt-alkali, .pt-table .pt-alkaline, .pt-table .pt-transition, .pt-table .pt-basic, .pt-table .pt-post-transition, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-not-selected");
	// jQuery(".pt-table .pt-alkali, .pt-table .pt-alkaline, .pt-table .pt-transition, .pt-table .pt-basic, .pt-table .pt-post-transition, .pt-table .pt-metalloids, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-selected");
	jQuery(".pt-table .pt-alkali, .pt-table .pt-alkaline, .pt-table .pt-transition, .pt-table .pt-basic, .pt-table .pt-post-transition, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-selected");
	jQuery(".pt-element-desc div").hide();
  });

  jQuery("#cg-nonmetals").click(function() {
	jQuery(".pt-filter-nonmetal").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-nonmetal").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-nonmetal").addClass("pt-active");
	// jQuery(".pt-table .pt-element").not(".pt-table .pt-nonmetal, .pt-table .pt-halogen, .pt-table .pt-noble, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-not-selected");
	jQuery(".pt-table .pt-element").not(".pt-table .pt-nonmetal, .pt-table .pt-halogen, .pt-table .pt-noble").addClass("pt-not-selected");
	// jQuery(".pt-table .pt-nonmetal, .pt-table .pt-halogen, .pt-table .pt-noble, .pt-table .pt-lanthanide, .pt-table .pt-actinide").addClass("pt-selected");
	jQuery(".pt-table .pt-nonmetal, .pt-table .pt-halogen, .pt-table .pt-noble").addClass("pt-selected");
	jQuery(".pt-element-desc div").hide();
  });

  jQuery("#cg-metalloids").click(function() {
	jQuery(".pt-filter-metalloids").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-metalloids").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-metalloids").addClass("pt-active");
	jQuery(".pt-table .pt-element").not(".pt-table .pt-metalloids").addClass("pt-not-selected");
	jQuery(".pt-table .pt-metalloids").addClass("pt-selected");
	jQuery(".pt-element-desc div").hide();
  });

  jQuery("#cg-states").click(function() {
	jQuery(".pt-filter-states").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-states").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-states").addClass("pt-active");
	jQuery(".pt-table .pt-element").not(".pt-table .pt-gas, .pt-table .pt-liquid, .pt-table .pt-solid, .pt-table .pt-unknown").addClass("pt-not-selected");
	jQuery(".pt-table .pt-gas, .pt-table .pt-liquid, .pt-table .pt-solid, .pt-table .pt-unknown").addClass("pt-selected");
	jQuery(".pt-element-desc div").hide();
  });

  jQuery("#cg-groups").click(function() {
	jQuery(".pt-filter-groups").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-groups").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-groups").addClass("pt-active");
	jQuery(".pt-table .pt-element").not(".pt-table .g1, .pt-table .g2, .pt-table .g3, .pt-table .g4, .pt-table .g5, .pt-table .g6, .pt-table .g7, .pt-table .g8, .pt-table .g9, .pt-table .g10, .pt-table .g11, .pt-table .g12, .pt-table .g13, .pt-table .g14, .pt-table .g15, .pt-table .g16, .pt-table .g17, .pt-table .g18").addClass("pt-not-selected");
	jQuery(".pt-table .g1, .pt-table .g2, .pt-table .g3, .pt-table .g4, .pt-table .g5, .pt-table .g6, .pt-table .g7, .pt-table .g8, .pt-table .g9, .pt-table .g10, .pt-table .g11, .pt-table .g12, .pt-table .g13, .pt-table .g14, .pt-table .g15, .pt-table .g16, .pt-table .g17, .pt-table .g18").addClass("pt-selected");
	jQuery(".pt-groups-desc").show();
	jQuery(".pt-element-desc div").not(".pt-groups-desc").hide();
  });

  jQuery("#cg-periods").click(function() {
	jQuery(".pt-filter-periods").css({"display": "inline-block"});
	jQuery(".pt-filter-hide .pt-color-guide").not(".pt-filter-periods").hide();
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-filter-periods").addClass("pt-active");
	jQuery(".pt-table .pt-element").not(".pt-table .p1, .pt-table .p2, .pt-table .p3, .pt-table .p4, .pt-table .p5, .pt-table .p6, .pt-table .p7").addClass("pt-not-selected");
	jQuery(".pt-table .p1, .pt-table .p2, .pt-table .p3, .pt-table .p4, .pt-table .p5, .pt-table .p6, .pt-table .p7");
	jQuery(".pt-periods-desc").show();
	jQuery(".pt-element-desc div").not(".pt-periods-desc").hide();
  });

  // Element groups
  jQuery(".pt-color-guide").click(function() {
	jQuery(this).addClass("pt-active");
	jQuery("#cg-all").removeClass("pt-active");
	jQuery("button#pt-reset").show();
	// jQuery(this).siblings().each(function(){
	jQuery(this).siblings().each(function(){
	  jQuery(this).removeClass("pt-active");
	});

	if (jQuery(".pt-element#cg-alkali").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-alkali").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-alkali").addClass("pt-selected");
	  jQuery(".pt-alkali-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-alkali-desc").hide();
	}
	if (jQuery(".pt-element#cg-alkaline").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-alkaline").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-alkaline").addClass("pt-selected");
	  jQuery(".pt-alkaline-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-alkaline-desc").hide();
	}
	if (jQuery(".pt-element#cg-transition").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-transition").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-transition").addClass("pt-selected");
	  jQuery(".pt-transition-metals-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-transition-metals-desc").hide();
	}
	if (jQuery(".pt-element#cg-post-transition").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-post-transition").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-post-transition").addClass("pt-selected");
	  jQuery(".pt-post-transition-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-post-transition-desc").hide();
	}
	if (jQuery(".pt-element#cg-metalloids").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-metalloids").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-metalloids").addClass("pt-selected");
	  jQuery(".pt-metalloids-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-metalloids-desc").hide();
	}
	if (jQuery(".pt-element#cg-basic").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-basic").addClass("pt-not-selected");
	  jQuery(".pt-table .basic").addClass("pt-selected");
	  jQuery(".pt-basic-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-basic-desc").hide();
	}
	if (jQuery(".pt-element#cg-semimetal").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-semimetal").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-semimetal").addClass("pt-selected");
	  jQuery(".pt-semimetal-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-semimetal-desc").hide();
	}
	if (jQuery(".pt-element#cg-nonmetal").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-nonmetal").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-nonmetal").addClass("pt-selected");
	  jQuery(".pt-nonmetals-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-nonmetals-desc").hide();
	}
	if (jQuery(".pt-element#cg-halogen").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-halogen").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-halogen").addClass("pt-selected");
	  jQuery(".pt-halogens-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-halogens-desc").hide();
	}
	if (jQuery(".pt-element#cg-noble").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-noble").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-noble").addClass("pt-selected");
	  jQuery(".pt-nobel-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-nobel-desc").hide();
	}
	if (jQuery(".pt-element#cg-lanthanide").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-lanthanide").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-lanthanide").addClass("pt-selected");
	  jQuery(".pt-lanthanides-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-lanthanides-desc").hide();
	}
	if (jQuery(".pt-element#cg-actinide").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-actinide").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-actinide").addClass("pt-selected");
	  jQuery(".pt-actinides-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-actinides-desc").hide();
	}
	if (jQuery(".pt-element#cg-gas").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-gas").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-gas").addClass("pt-selected");
	  jQuery(".pt-gas-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-gas-desc").hide();
	}
	if (jQuery(".pt-element#cg-liquid").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-liquid").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-gas").addClass("pt-selected");
	  jQuery(".pt-liquid-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-liquid-desc").hide();
	}
	if (jQuery(".pt-element#cg-unknown").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-unknown").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-gas").addClass("pt-selected");
	  jQuery(".pt-unknown-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-unknown-desc").hide();
	}
	if (jQuery(".pt-element#cg-solid").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".pt-solid").addClass("pt-not-selected");
	  jQuery(".pt-table .pt-solid").addClass("pt-selected");
	  jQuery(".pt-solid-desc").show();
	  jQuery(".pt-element-desc div").not(".pt-solid-desc").hide();
	}
	if (jQuery(".pt-element#cg-g1").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g1").addClass("pt-not-selected");
	  jQuery(".pt-table .g1").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g2").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g2").addClass("pt-not-selected");
	  jQuery(".pt-table .g2").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g3").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g3").addClass("pt-not-selected");
	  jQuery(".pt-table .g3").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g4").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g4").addClass("pt-not-selected");
	  jQuery(".pt-table .g4").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g5").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g5").addClass("pt-not-selected");
	  jQuery(".pt-table .g5").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g6").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g6").addClass("pt-not-selected");
	  jQuery(".pt-table .g6").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g7").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g7").addClass("pt-not-selected");
	  jQuery(".pt-table .g7").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g8").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g8").addClass("pt-not-selected");
	  jQuery(".pt-table .g8").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g9").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g9").addClass("pt-not-selected");
	  jQuery(".pt-table .g9").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g10").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g10").addClass("pt-not-selected");
	  jQuery(".pt-table .g10").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g11").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g11").addClass("pt-not-selected");
	  jQuery(".pt-table .g11").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g12").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g12").addClass("pt-not-selected");
	  jQuery(".pt-table .g12").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g13").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g13").addClass("pt-not-selected");
	  jQuery(".pt-table .g13").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g14").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g14").addClass("pt-not-selected");
	  jQuery(".pt-table .g14").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g15").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g15").addClass("pt-not-selected");
	  jQuery(".pt-table .g15").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g15").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g15").addClass("pt-not-selected");
	  jQuery(".pt-table .g15").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g16").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g16").addClass("pt-not-selected");
	  jQuery(".pt-table .g16").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g17").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g17").addClass("pt-not-selected");
	  jQuery(".pt-table .g17").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-g18").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".g18").addClass("pt-not-selected");
	  jQuery(".pt-table .g18").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p1").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p1").addClass("pt-not-selected");
	  jQuery(".pt-table .p1").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p2").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p2").addClass("pt-not-selected");
	  jQuery(".pt-table .p2").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p3").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p3").addClass("pt-not-selected");
	  jQuery(".pt-table .p3").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p4").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p4").addClass("pt-not-selected");
	  jQuery(".pt-table .p4").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p5").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p5").addClass("pt-not-selected");
	  jQuery(".pt-table .p5").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p6").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p6").addClass("pt-not-selected");
	  jQuery(".pt-table .p6").addClass("pt-selected");
	}
	if (jQuery(".pt-element#cg-p7").hasClass("pt-active")) {
	  jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	  jQuery(".pt-table .pt-element").removeClass("pt-selected");
	  jQuery(".pt-table .pt-element").not(".p7").addClass("pt-not-selected");
	  jQuery(".pt-table .p7").addClass("pt-selected");
	}
  });

  // Toggle all elements
  jQuery("#cg-all, button#pt-reset").click(function(){
	jQuery(".pt-color-guide, .pt-group-filter").removeClass("pt-active");
	jQuery(".pt-element#cg-all").addClass("pt-active");
	jQuery(".pt-table .pt-element").removeClass("pt-not-selected");
	jQuery(".pt-table .pt-element").removeClass("pt-selected");
	jQuery(".pt-filter-hide .pt-color-guide").css({"display": "none"});
	jQuery(".pt-element-desc div, button#pt-reset").hide();
  });

  // Accordion
  jQuery(".pt-toggle").click(function(e) {
	e.preventDefault();
	var jQuerythis = jQuery(this);
	if (jQuerythis.next().hasClass("pt-show")) {
	  jQuerythis.next().removeClass("pt-show");
	  jQuerythis.next().slideUp(350);
	  jQuerythis.next().parent().removeClass("pt-active-ico");
	} else {
	  jQuerythis.parent().parent().find("li .pt-inner").removeClass("pt-show");
	  jQuerythis.parent().parent().find("li .pt-inner").slideUp(350);
	  jQuerythis.next().parent().addClass("pt-active-ico");
	  jQuerythis.next().toggleClass("pt-show");
	  jQuerythis.next().slideToggle(350);
	}
  });

  jQuery(".pt-toggle").click(function(e) {
	e.preventDefault();
	//jQuery(".pt-active-ico").not(jQuery(this)).removeClass("pt-active-ico");
	jQuery(this).next().parent().siblings().removeClass("pt-active-ico");
  });

  // Close element if open before clicking on the table
  jQuery(".pt-table .pt-element").click(function(){
	jQuery("li .pt-inner").removeClass("pt-show");
	jQuery("li .pt-inner").slideUp(350);
	jQuery(".pt-table-search li").show();
	jQuery(".pt-table-search li").css({"display": "block"});
  });

  // Hide back to top
  jQuery(".pt-to-top").hide();

  // Open all internal links in new window
  jQuery("#pt-search-table a").attr('target', '_blank');

// Fade in back to top
jQuery(document).scroll(function() {
  var y = jQuery(this).scrollTop();
  if (y > 300) {
	jQuery('.pt-to-top').fadeIn();
  } else {
	jQuery('.pt-to-top').fadeOut();
  }
});

// Real-time search
function searchFunction() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById("pt-real-search");
  filter = input.value.toUpperCase();
  ul = document.getElementById("pt-search-table");
  li = ul.getElementsByTagName("li");

  for (i = 0; i < li.length; i++) {
	a = li[i].getElementsByTagName("a")[0];
	txtValue = a.textContent || a.pt-innerText;
	if (txtValue.toUpperCase().indexOf(filter) > -1) {
	  li[i].style.display = "";
	} else {
	  li[i].style.display = "none";
	}
  }
}
</script>

<style type="text/css">
	.pt-wrap {
		-webkit-box-sizing: border-box !important;
		box-sizing: border-box !important;
		margin: 0 auto !important;
		min-height: 100vh !important;
	}
	.pt-wrap h1 {
		margin-top: 0 !important;
		padding-bottom: 0.5rem !important;
		border-bottom: 0.125rem solid rgba(0, 0, 0, 0.5) !important;
	}
	.pt-wrap p {
		margin: 0 0 20px;
	}
	.pt-wrap img {
		width: auto;
		max-width: 100%;
		height: auto;
	}
	.pt-text-center {
		text-align: center;
	}
	.pt-text-right {
		text-align: right;
	}
	main.pt-wrap {
		width: 100%;
		padding: 4em 0;
	}
	main.pt-wrap .container {
		max-width: 1200px;
	}
	main.pt-wrap .pt-table {
		display: -ms-grid;
		display: grid;
		margin-bottom: 20px;
		-ms-grid-columns: auto;
		grid-template-columns: auto;
		-ms-grid-rows: 68px 68px 68px 68px 68px 68px 68px 40px 68px 68px;
		grid-template-rows: 68px 68px 68px 68px 68px 68px 68px 40px 68px 68px;
	}
	main.pt-wrap .pt-table > :nth-child(1) {
		-ms-grid-row: 1;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(2) {
		-ms-grid-row: 2;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(3) {
		-ms-grid-row: 3;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(4) {
		-ms-grid-row: 4;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(5) {
		-ms-grid-row: 5;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(6) {
		-ms-grid-row: 6;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(7) {
		-ms-grid-row: 7;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(8) {
		-ms-grid-row: 8;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(9) {
		-ms-grid-row: 9;
		-ms-grid-column: 1;
	}
	main.pt-wrap .pt-table > :nth-child(10) {
		-ms-grid-row: 10;
		-ms-grid-column: 1;
	}
	.pt-intro-copy {
		width: 70%;
		float: left;
	}
	.pt-social {
		width: 30%;
		float: right;
	}
	.pt-social p {
		margin: 0;
		vertical-align: middle;
	}
	.pt-social img {
		color: #555759;
		font-size: 14px;
		text-decoration: none;
		margin-left: 7px;
		display: inline-block;
	}
	.pt-social img:hover {
		cursor: pointer;
	}
	.pt-social .pt-social-download {
		color: #555759;
		font-size: 14px;
		text-decoration: none;
	}
	.pt-social img {
		display: inline-block;
		vertical-align: middle;
	}
	.pt-element {
		position: relative;
		background: rgba(0, 0, 0, 0.25);
		padding: 0.25rem;
		margin: 2px;
	}
	.pt-inner .pt-element {
		width: 150px;
		height: 150px;
		padding: 0.5rem;
	}
	.pt-table {
		-ms-grid-columns: 62px;
		grid-template-columns: 62px;
		-ms-grid-rows: 62px;
		grid-template-rows: 62px;
	}
	.pt-table > :nth-child(1) {
		-ms-grid-row: 1;
		-ms-grid-column: 1;
	}
	.pt-table .pt-element {
		width: 62px;
		height: 62px;
	}
	.pt-element a {
		color: #fff;
		text-decoration: none;
		display: block;
	}
	.pt-element .pt-element-number,
	.pt-element .pt-element-symbol,
	.pt-element .pt-element-name,
	.pt-element .pt-element-weight {
		color: #fff;
		line-height: 1;
	}
	.pt-element .pt-element-number {
		font-size: 13px;
		text-align: right;
		margin-bottom: 12px;
		float: right;
		display: inline-block;
	}
	.pt-inner .pt-element .pt-element-number {
		font-size: 30px;
	}
	.pt-element .pt-element-symbol {
		font-size: 20px;
		font-weight: 400;
		margin: 0;
		float: left;
		display: inline-block;
	}
	.pt-inner .pt-element .pt-element-symbol {
		font-size: 55px;
	}
	.pt-element .pt-element-name {
		font-size: 8px;
		margin-bottom: 3px;
		clear: both;
	}
	.pt-inner .pt-element .pt-element-name {
		font-size: 12px;
		position: absolute;
		bottom: 25px;
	}
	.pt-element .pt-element-weight {
		font-size: 11px;
	}
	.pt-inner .pt-element .pt-element-weight {
		position: absolute;
		bottom: 10px;
	}
	.pt-table-filters .pt-element:hover {
		z-index: 2;
		cursor: pointer;
	}
	.pt-table .pt-element:hover {
		-webkit-transform: scale(1.05);
		-ms-transform: scale(1.05);
		transform: scale(1.05);
		z-index: 2;
		cursor: pointer;
	}
	.pt-table-filters .pt-element:hover,
	.pt-filter-hide .pt-element:hover {
		background-color: #005daa;
		color: #fff;
	}
	.pt-element.pt-key {
		background-color: #f5f6f8;
		position: relative;
		border: 1px solid #bebbbb;
		width: auto;
		height: auto;
	}
	.pt-element.pt-key:hover {
		cursor: default;
		-webkit-transform: scale(1);
		-ms-transform: scale(1);
		transform: scale(1);
	}
	.pt-element .pt-key-title {
		color: #555759;
		font-size: 14px;
		font-weight: 700;
		position: absolute;
		top: -20px;
		left: 0;
	}
	.pt-element .pt-key-info img {
		margin: 0 auto;
		display: block;
		position: absolute;
		top: 50%;
		-webkit-transform: translate(0, -50%);
		-ms-transform: translate(0, -50%);
		transform: translate(0, -50%);
	}
	.pt-element.pt-color-guide,
	.pt-group-filter {
		background-color: transparent;
		color: #555759;
		font-size: 15px;
		font-weight: 400;
		line-height: 1;
		text-align: center;
		padding: 7px 20px;
		border: 1px solid #555759;
		border-radius: 4px;
	}
	.pt-element.pt-color-guide:hover,
	.pt-group-filter:hover {
		cursor: pointer;
	}
	.pt-group-filter:focus {
		outline: none;
	}
	.pt-element.pt-color-guide.pt-active,
	.pt-group-filter.pt-active {
		background-color: #555759;
		color: #fff;
	}
	.pt-element.pt-color-guide.pt-active:hover,
	.pt-group-filter.pt-active:hover {
		background-color: #6e7175;
	}
	
	.pt-table .pt-not-selected {
		background: #e6e6e6;
	}
	.pt-not-selected .pt-element-number,
	.pt-not-selected .pt-element-symbol,
	.pt-not-selected .pt-element-name,
	.pt-not-selected .pt-element-weight {
		color: #e6e6e6 !important;
	}
	.pt-table .pt-selected {
		opacity: 1 !important;
	}
	.pt-table .pt-element-desc {
		padding: 20px 35px;
		-ms-grid-row: 4;
		-ms-grid-row-span: -3;
		-ms-grid-column: 13;
		-ms-grid-column-span: -10;
		grid-area: 4/13/1/3;
	}
	.pt-table .pt-element-desc h2 {
		color: #555759;
		font-size: 20px;
		font-weight: 700;
		line-height: 1.03;
		margin-bottom: 10px;
	}
	.pt-table .pt-element-desc p {
		color: #555759;
		font-size: 12px;
		margin-bottom: 20px;
	}
	.pt-table-filters {
		background-color: #f5f6f8;
		margin-bottom: 10px;
		padding: 13px 30px;
		border: 1px solid #bebbbb;
	}
	.pt-filter-title {
		margin-right: 25px;
		float: left;
	}
	.pt-filter-title p {
		margin: 4px 0 0;
	}
	.pt-filter-title img {
		display: inline-block;
		vertical-align: middle;
	}
	.pt-filter-hide {
		width: 100%;
		margin-left: 100px;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: horizontal;
		-webkit-box-direction: normal;
		-ms-flex-direction: row;
		flex-direction: row;
	}
	.pt-filter-hide .pt-color-guide {
		display: none;
	}
	.pt-filter-hide .pt-element {
		margin-top: 10px;
	}
	#cg-all {
		margin-right: 25px;
		position: relative;
	}
	#cg-all::after {
		content: "";
		width: 25px;
		height: 25px;
		display: block;
		border-right: 1px solid #bebbbb;
		position: absolute;
		right: -18px;
		top: 0;
	}
	#cg-nonmetals {
		margin-right: 25px;
		position: relative;
	}
	#cg-nonmetals::after {
		content: "";
		width: 25px;
		height: 25px;
		display: block;
		border-right: 1px solid #bebbbb;
		position: absolute;
		right: -18px;
		top: 0;
	}
	#cg-states {
		margin-right: 25px;
		position: relative;
	}
	#cg-states::after {
		content: "";
		width: 25px;
		height: 25px;
		display: block;
		border-right: 1px solid #bebbbb;
		position: absolute;
		right: -18px;
		top: 0;
	}
	button#pt-reset {
		background: none;
		color: #555759;
		font-size: 14px;
		margin: 5px 0 0 100px;
		padding: 0;
		clear: both;
		border: none;
	}
	button#pt-reset:hover {
		cursor: pointer;
	}
	button#pt-reset:focus {
		outline: none;
	}
	#h {
		-ms-grid-row: 1;
		-ms-grid-column: 1;
		grid-area: 1/1/1/1;
	}
	#he {
		-ms-grid-row: 1;
		-ms-grid-column: 18;
		grid-area: 1/18/1/18;
	}
	#li {
		-ms-grid-row: 2;
		-ms-grid-column: 1;
		grid-area: 2/1/2/1;
	}
	#be {
		-ms-grid-row: 2;
		-ms-grid-column: 2;
		grid-area: 2/2/2/2;
	}
	#b {
		-ms-grid-row: 2;
		-ms-grid-column: 13;
		grid-area: 2/13/2/13;
	}
	#c {
		-ms-grid-row: 2;
		-ms-grid-column: 14;
		grid-area: 2/14/2/14;
	}
	#n {
		-ms-grid-row: 2;
		-ms-grid-column: 15;
		grid-area: 2/15/2/15;
	}
	#o {
		-ms-grid-row: 2;
		-ms-grid-column: 16;
		grid-area: 2/16/2/16;
	}
	#f {
		-ms-grid-row: 2;
		-ms-grid-column: 17;
		grid-area: 2/17/2/17;
	}
	#ne {
		-ms-grid-row: 2;
		-ms-grid-column: 18;
		grid-area: 2/18/2/18;
	}
	#na {
		-ms-grid-row: 3;
		-ms-grid-column: 1;
		grid-area: 3/1/3/1;
	}
	#mg {
		-ms-grid-row: 3;
		-ms-grid-column: 2;
		grid-area: 3/2/3/2;
	}
	#al {
		-ms-grid-row: 3;
		-ms-grid-column: 13;
		grid-area: 3/13/3/13;
	}
	#si {
		-ms-grid-row: 3;
		-ms-grid-column: 14;
		grid-area: 3/14/3/14;
	}
	#p {
		-ms-grid-row: 3;
		-ms-grid-column: 15;
		grid-area: 3/15/3/15;
	}
	#s {
		-ms-grid-row: 3;
		-ms-grid-column: 16;
		grid-area: 3/16/3/16;
	}
	#cl {
		-ms-grid-row: 3;
		-ms-grid-column: 17;
		grid-area: 3/17/3/17;
	}
	#ar {
		-ms-grid-row: 3;
		-ms-grid-column: 18;
		grid-area: 3/18/3/18;
	}
	#k {
		-ms-grid-row: 4;
		-ms-grid-column: 1;
		grid-area: 4/1/4/1;
	}
	#ca {
		-ms-grid-row: 4;
		-ms-grid-column: 2;
		grid-area: 4/2/4/2;
	}
	#sc {
		-ms-grid-row: 4;
		-ms-grid-column: 3;
		grid-area: 4/3/4/3;
	}
	#ti {
		-ms-grid-row: 4;
		-ms-grid-column: 4;
		grid-area: 4/4/4/4;
	}
	#v {
		-ms-grid-row: 4;
		-ms-grid-column: 5;
		grid-area: 4/5/4/5;
	}
	#cr {
		-ms-grid-row: 4;
		-ms-grid-column: 6;
		grid-area: 4/6/4/6;
	}
	#mn {
		-ms-grid-row: 4;
		-ms-grid-column: 7;
		grid-area: 4/7/4/7;
	}
	#fe {
		-ms-grid-row: 4;
		-ms-grid-column: 8;
		grid-area: 4/8/4/8;
	}
	#co {
		-ms-grid-row: 4;
		-ms-grid-column: 9;
		grid-area: 4/9/4/9;
	}
	#ni {
		-ms-grid-row: 4;
		-ms-grid-column: 10;
		grid-area: 4/10/4/10;
	}
	#cu {
		-ms-grid-row: 4;
		-ms-grid-column: 11;
		grid-area: 4/11/4/11;
	}
	#zn {
		-ms-grid-row: 4;
		-ms-grid-column: 12;
		grid-area: 4/12/4/12;
	}
	#ga {
		-ms-grid-row: 4;
		-ms-grid-column: 13;
		grid-area: 4/13/4/13;
	}
	#ge {
		-ms-grid-row: 4;
		-ms-grid-column: 14;
		grid-area: 4/14/4/14;
	}
	#as {
		-ms-grid-row: 4;
		-ms-grid-column: 15;
		grid-area: 4/15/4/15;
	}
	#se {
		-ms-grid-row: 4;
		-ms-grid-column: 16;
		grid-area: 4/16/4/16;
	}
	#br {
		-ms-grid-row: 4;
		-ms-grid-column: 17;
		grid-area: 4/17/4/17;
	}
	#kr {
		-ms-grid-row: 4;
		-ms-grid-column: 18;
		grid-area: 4/18/4/18;
	}
	#rb {
		-ms-grid-row: 5;
		-ms-grid-column: 1;
		grid-area: 5/1/5/1;
	}
	#sr {
		-ms-grid-row: 5;
		-ms-grid-column: 2;
		grid-area: 5/2/5/2;
	}
	#y {
		-ms-grid-row: 5;
		-ms-grid-column: 3;
		grid-area: 5/3/5/3;
	}
	#zr {
		-ms-grid-row: 5;
		-ms-grid-column: 4;
		grid-area: 5/4/5/4;
	}
	#nb {
		-ms-grid-row: 5;
		-ms-grid-column: 5;
		grid-area: 5/5/5/5;
	}
	#mo {
		-ms-grid-row: 5;
		-ms-grid-column: 6;
		grid-area: 5/6/5/6;
	}
	#tc {
		-ms-grid-row: 5;
		-ms-grid-column: 7;
		grid-area: 5/7/5/7;
	}
	#ru {
		-ms-grid-row: 5;
		-ms-grid-column: 8;
		grid-area: 5/8/5/8;
	}
	#rh {
		-ms-grid-row: 5;
		-ms-grid-column: 9;
		grid-area: 5/9/5/9;
	}
	#pd {
		-ms-grid-row: 5;
		-ms-grid-column: 10;
		grid-area: 5/10/5/10;
	}
	#ag {
		-ms-grid-row: 5;
		-ms-grid-column: 11;
		grid-area: 5/11/5/11;
	}
	#cd {
		-ms-grid-row: 5;
		-ms-grid-column: 12;
		grid-area: 5/12/5/12;
	}
	#in {
		-ms-grid-row: 5;
		-ms-grid-column: 13;
		grid-area: 5/13/5/13;
	}
	#sn {
		-ms-grid-row: 5;
		-ms-grid-column: 14;
		grid-area: 5/14/5/14;
	}
	#sb {
		-ms-grid-row: 5;
		-ms-grid-column: 15;
		grid-area: 5/15/5/15;
	}
	#te {
		-ms-grid-row: 5;
		-ms-grid-column: 16;
		grid-area: 5/16/5/16;
	}
	#i {
		-ms-grid-row: 5;
		-ms-grid-column: 17;
		grid-area: 5/17/5/17;
	}
	#xe {
		-ms-grid-row: 5;
		-ms-grid-column: 18;
		grid-area: 5/18/5/18;
	}
	#cs {
		-ms-grid-row: 6;
		-ms-grid-column: 1;
		grid-area: 6/1/6/1;
	}
	#ba {
		-ms-grid-row: 6;
		-ms-grid-column: 2;
		grid-area: 6/2/6/2;
	}
	#hf {
		-ms-grid-row: 6;
		-ms-grid-column: 4;
		grid-area: 6/4/6/4;
	}
	#ta {
		-ms-grid-row: 6;
		-ms-grid-column: 5;
		grid-area: 6/5/6/5;
	}
	#w {
		-ms-grid-row: 6;
		-ms-grid-column: 6;
		grid-area: 6/6/6/6;
	}
	#re {
		-ms-grid-row: 6;
		-ms-grid-column: 7;
		grid-area: 6/7/6/7;
	}
	#os {
		-ms-grid-row: 6;
		-ms-grid-column: 8;
		grid-area: 6/8/6/8;
	}
	#ir {
		-ms-grid-row: 6;
		-ms-grid-column: 9;
		grid-area: 6/9/6/9;
	}
	#pt {
		-ms-grid-row: 6;
		-ms-grid-column: 10;
		grid-area: 6/10/6/10;
	}
	#au {
		-ms-grid-row: 6;
		-ms-grid-column: 11;
		grid-area: 6/11/6/11;
	}
	#hg {
		-ms-grid-row: 6;
		-ms-grid-column: 12;
		grid-area: 6/12/6/12;
	}
	#tl {
		-ms-grid-row: 6;
		-ms-grid-column: 13;
		grid-area: 6/13/6/13;
	}
	#pb {
		-ms-grid-row: 6;
		-ms-grid-column: 14;
		grid-area: 6/14/6/14;
	}
	#bi {
		-ms-grid-row: 6;
		-ms-grid-column: 15;
		grid-area: 6/15/6/15;
	}
	#po {
		-ms-grid-row: 6;
		-ms-grid-column: 16;
		grid-area: 6/16/6/16;
	}
	#at {
		-ms-grid-row: 6;
		-ms-grid-column: 17;
		grid-area: 6/17/6/17;
	}
	#rn {
		-ms-grid-row: 6;
		-ms-grid-column: 18;
		grid-area: 6/18/6/18;
	}
	#fr {
		-ms-grid-row: 7;
		-ms-grid-column: 1;
		grid-area: 7/1/7/1;
	}
	#ra {
		-ms-grid-row: 7;
		-ms-grid-column: 2;
		grid-area: 7/2/7/2;
	}
	#rf {
		-ms-grid-row: 7;
		-ms-grid-column: 4;
		grid-area: 7/4/7/4;
	}
	#db {
		-ms-grid-row: 7;
		-ms-grid-column: 5;
		grid-area: 7/5/7/5;
	}
	#sg {
		-ms-grid-row: 7;
		-ms-grid-column: 6;
		grid-area: 7/6/7/6;
	}
	#bh {
		-ms-grid-row: 7;
		-ms-grid-column: 7;
		grid-area: 7/7/7/7;
	}
	#hs {
		-ms-grid-row: 7;
		-ms-grid-column: 8;
		grid-area: 7/8/7/8;
	}
	#mt {
		-ms-grid-row: 7;
		-ms-grid-column: 9;
		grid-area: 7/9/7/9;
	}
	#ds {
		-ms-grid-row: 7;
		-ms-grid-column: 10;
		grid-area: 7/10/7/10;
	}
	#rg {
		-ms-grid-row: 7;
		-ms-grid-column: 11;
		grid-area: 7/11/7/11;
	}
	#cn {
		-ms-grid-row: 7;
		-ms-grid-column: 12;
		grid-area: 7/12/7/12;
	}
	#nh {
		-ms-grid-row: 7;
		-ms-grid-column: 13;
		grid-area: 7/13/7/13;
	}
	#fl {
		-ms-grid-row: 7;
		-ms-grid-column: 14;
		grid-area: 7/14/7/14;
	}
	#mc {
		-ms-grid-row: 7;
		-ms-grid-column: 15;
		grid-area: 7/15/7/15;
	}
	#lv {
		-ms-grid-row: 7;
		-ms-grid-column: 16;
		grid-area: 7/16/7/16;
	}
	#ts {
		-ms-grid-row: 7;
		-ms-grid-column: 17;
		grid-area: 7/17/7/17;
	}
	#og {
		-ms-grid-row: 7;
		-ms-grid-column: 18;
		grid-area: 7/18/7/18;
	}
	#la {
		-ms-grid-row: 9;
		-ms-grid-column: 4;
		grid-area: 9/4/9/4;
	}
	#ce {
		-ms-grid-row: 9;
		-ms-grid-column: 5;
		grid-area: 9/5/9/5;
	}
	#pr {
		-ms-grid-row: 9;
		-ms-grid-column: 6;
		grid-area: 9/6/9/6;
	}
	#nd {
		-ms-grid-row: 9;
		-ms-grid-column: 7;
		grid-area: 9/7/9/7;
	}
	#pm {
		-ms-grid-row: 9;
		-ms-grid-column: 8;
		grid-area: 9/8/9/8;
	}
	#sm {
		-ms-grid-row: 9;
		-ms-grid-column: 9;
		grid-area: 9/9/9/9;
	}
	#eu {
		-ms-grid-row: 9;
		-ms-grid-column: 10;
		grid-area: 9/10/9/10;
	}
	#gd {
		-ms-grid-row: 9;
		-ms-grid-column: 11;
		grid-area: 9/11/9/11;
	}
	#tb {
		-ms-grid-row: 9;
		-ms-grid-column: 12;
		grid-area: 9/12/9/12;
	}
	#dy {
		-ms-grid-row: 9;
		-ms-grid-column: 13;
		grid-area: 9/13/9/13;
	}
	#ho {
		-ms-grid-row: 9;
		-ms-grid-column: 14;
		grid-area: 9/14/9/14;
	}
	#er {
		-ms-grid-row: 9;
		-ms-grid-column: 15;
		grid-area: 9/15/9/15;
	}
	#tm {
		-ms-grid-row: 9;
		-ms-grid-column: 16;
		grid-area: 9/16/9/16;
	}
	#yb {
		-ms-grid-row: 9;
		-ms-grid-column: 17;
		grid-area: 9/17/9/17;
	}
	#lu {
		-ms-grid-row: 9;
		-ms-grid-column: 18;
		grid-area: 9/18/9/18;
	}
	#ac {
		-ms-grid-row: 10;
		-ms-grid-column: 4;
		grid-area: 10/4/10/4;
	}
	#th {
		-ms-grid-row: 10;
		-ms-grid-column: 5;
		grid-area: 10/5/10/5;
	}
	#pa {
		-ms-grid-row: 10;
		-ms-grid-column: 6;
		grid-area: 10/6/10/6;
	}
	#u {
		-ms-grid-row: 10;
		-ms-grid-column: 7;
		grid-area: 10/7/10/7;
	}
	#np {
		-ms-grid-row: 10;
		-ms-grid-column: 8;
		grid-area: 10/8/10/8;
	}
	#pu {
		-ms-grid-row: 10;
		-ms-grid-column: 9;
		grid-area: 10/9/10/9;
	}
	#am {
		-ms-grid-row: 10;
		-ms-grid-column: 10;
		grid-area: 10/10/10/10;
	}
	#cm {
		-ms-grid-row: 10;
		-ms-grid-column: 11;
		grid-area: 10/11/10/11;
	}
	#bk {
		-ms-grid-row: 10;
		-ms-grid-column: 12;
		grid-area: 10/12/10/12;
	}
	#cf {
		-ms-grid-row: 10;
		-ms-grid-column: 13;
		grid-area: 10/13/10/13;
	}
	#es {
		-ms-grid-row: 10;
		-ms-grid-column: 14;
		grid-area: 10/14/10/14;
	}
	#fm {
		-ms-grid-row: 10;
		-ms-grid-column: 15;
		grid-area: 10/15/10/15;
	}
	#md {
		-ms-grid-row: 10;
		-ms-grid-column: 16;
		grid-area: 10/16/10/16;
	}
	#no {
		-ms-grid-row: 10;
		-ms-grid-column: 17;
		grid-area: 10/17/10/17;
	}
	#lr {
		-ms-grid-row: 10;
		-ms-grid-column: 18;
		grid-area: 10/18/10/18;
	}
	#cg-alkali {
		-ms-grid-row: 1;
		-ms-grid-column: 1;
		grid-area: 1/1/1/1;
	}
	#cg-alkaline {
		-ms-grid-row: 1;
		-ms-grid-column: 2;
		grid-area: 1/2/1/2;
	}
	#cg-transition {
		-ms-grid-row: 1;
		-ms-grid-column: 3;
		grid-area: 1/3/1/3;
	}
	#cg-basic {
		-ms-grid-row: 1;
		-ms-grid-column: 4;
		grid-area: 1/4/1/4;
	}
	#cg-semimetal {
		-ms-grid-row: 1;
		-ms-grid-column: 5;
		grid-area: 1/5/1/5;
	}
	#cg-nonmetal {
		-ms-grid-row: 1;
		-ms-grid-column: 6;
		grid-area: 1/6/1/6;
	}
	#cg-halogen {
		-ms-grid-row: 1;
		-ms-grid-column: 7;
		grid-area: 1/7/1/7;
	}
	#cg-noble {
		-ms-grid-row: 1;
		-ms-grid-column: 8;
		grid-area: 1/8/1/8;
	}
	#cg-lanthanide {
		-ms-grid-row: 1;
		-ms-grid-column: 9;
		grid-area: 1/9/1/9;
	}
	#cg-actinide {
		-ms-grid-row: 1;
		-ms-grid-column: 10;
		grid-area: 1/10/1/10;
	}
	#lan {
		-ms-grid-row: 6;
		-ms-grid-column: 3;
		grid-area: 6/3/6/3;
	}
	#act {
		-ms-grid-row: 7;
		-ms-grid-column: 3;
		grid-area: 7/3/7/3;
	}
	#key {
		-ms-grid-row: 9;
		-ms-grid-row-span: 2;
		-ms-grid-column: 1;
		-ms-grid-column-span: 3;
		grid-area: 9/1/11/4;
	}
	.pt-accordion {
		list-style: none;
		margin: 0;
		padding: 0;
	}
	.pt-accordion .pt-inner {
		background-color: #f4f4f4;
		margin: 0;
		padding: 25px;
		overflow: hidden;
		display: none;
	}
	.pt-accordion li:nth-child(even) .pt-inner {
		background-color: #e6e6e6;
	}
	.pt-accordion li:nth-child(odd) .pt-inner {
		background-color: #d6d6d6;
	}
	.pt-accordion .pt-inner:target {
		display: block;
	}
	.pt-accordion li {
		margin: 0;
		display: block;
	}
	.pt-accordion p {
		color: #565757;
	}
	.pt-accordion li a.pt-toggle {
		background-color: #d6d6d6;
		width: 100%;
		padding: 20px;
		display: block;
		-webkit-transition: background 0.3s ease;
		-o-transition: background 0.3s ease;
		transition: background 0.3s ease;
		position: relative;
	}
	.pt-accordion li a.pt-toggle::before {
		background: url() right center no-repeat transparent;
		background-size: 14px;
		content: "";
		width: 14%;
		height: 17px;
		float: right;
		display: inline-block;
	}
	.pt-accordion li.pt-active-ico a.pt-toggle::before {
		background: url() right center no-repeat transparent;
		background-size: 14px;
	}
	.pt-accordion li:nth-child(even) a.pt-toggle {
		background-color: #e6e6e6;
	}
	.pt-accordion li a.pt-toggle:hover {
		background: rgba(0, 0, 0, 0.15);
		cursor: pointer;
	}
	.pt-accordion .pt-toggle p {
		margin-bottom: 0;
	}
	.pt-col-one-key {
		width: 33%;
		float: left;
		display: inline-block;
	}
	.pt-col-two-key {
		width: 33%;
		float: left;
		display: inline-block;
	}
	.pt-col-three-key {
		width: 20%;
		float: left;
		display: inline-block;
	}
	.pt-col-three-key p {
		text-align: right;
	}
	.pt-col-third {
		width: 33.3333%;
		float: left;
		display: inline-block;
	}
	.pt-col-atomic {
		width: 24%;
	}
	.pt-col-symbol p {
		text-align: center;
	}
	.pt-table-search {
		position: relative;
	}
	.pt-to-top {
		background-color: #a2a4aa;
		text-align: right;
		width: 100%;
		max-width: 1200px;
		margin: 0 auto;
		padding: 15px 30px;
		position: fixed;
		right: 0;
		bottom: 0;
		left: 0;
	}
	.pt-to-top a {
		color: #fff;
		font-size: 16px;
		text-decoration: none;
	}
	.pt-to-top img {
		height: 15px;
		display: inline-block;
	}
	.pt-search-box {
		padding: 0.75em 0.75em 0.75em 0;
	}
	.pt-search-box p {
		color: #555759;
		font-size: 14px;
		margin-bottom: 10px;
	}
	.pt-search-box input[type="text"] {
		font-size: 15px;
		width: 100%;
		max-width: 300px;
		padding: 7px 15px;
	}
	.pt-search-box input[type="text"]::-webkit-input-placeholder {
		color: #c4c3c3;
	}
	.pt-search-box input[type="text"]::-moz-placeholder {
		color: #c4c3c3;
	}
	.pt-search-box input[type="text"]:-ms-input-placeholder {
		color: #c4c3c3;
	}
	.pt-search-box input[type="text"]::-ms-input-placeholder {
		color: #c4c3c3;
	}
	.pt-search-box input[type="text"]::placeholder {
		color: #c4c3c3;
	}
	#pt-search-table {
		margin-bottom: 48px;
	}
	.pt-search-table-key {
		background-color: #727272;
		padding: 20px;
	}
	.pt-search-table-key p {
		color: #fff;
		margin-bottom: 0;
	}
	.pt-col-element {
		width: 15%;
		margin-right: 1.3333%;
		float: left;
	}
	.pt-col-desc {
		width: 43%;
		margin-right: 3.3333%;
		float: left;
	}
	.pt-col-detail {
		width: 32%;
		float: left;
	}
	.pt-table-mobile {
		display: none;
	}
	@media (max-width: 1040px) {
		.pt-col-desc {
			width: 75%;
			margin-right: 0;
			margin-left: 3%;
		}
		.pt-col-detail {
			margin-left: 19.3333%;
		}
	}
	@media (max-width: 885px) {
		.pt-table-filters,
		.pt-table {
			display: none !important;
		}
		.pt-table-mobile {
			display: block;
		}
		.pt-col-desc {
			width: 75%;
			margin-right: 0;
			margin-left: 6%;
		}
		.pt-col-detail {
			margin-left: 22.3333%;
		}
		.pt-intro-copy {
			width: 100%;
			float: none;
			display: block;
		}
		.pt-social {
			width: 100%;
			float: none;
			display: block;
		}
		.pt-social .pt-text-right {
			text-align: center;
			margin-bottom: 20px;
		}
		.pt-to-top {
			text-align: center;
		}
	}
	@media (max-width: 788px) {
		.pt-col-element {
			margin-bottom: 20px;
		}
		.pt-col-desc {
			width: 100%;
			margin-left: 0;
		}
		.pt-col-detail {
			width: 100%;
			margin-left: 0;
		}
	}
	.pt-group:after,
	.pt-table .pt-section.pt-element:after {
		content: "";
		display: table;
		clear: both;
	}
</style>

<main id="main" class="site-main pt-wrap" role="main">
	<div class="container">	
		<div class="pt-table">
			<section class="pt-element pt-nonmetal pt-gas g1 p1" id="h">
				<a href="/element/hydrogen-h">
					<div class="pt-element-number">1</div>
					<h2 class="pt-element-symbol">H</h2>
					<div class="pt-element-name">Hydrogen</div>
					<div class="pt-element-weight">1.008</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p1" id="he">
				<a href="/element/helium-he">
					<div class="pt-element-number">2</div>
					<h2 class="pt-element-symbol">He</h2>
					<div class="pt-element-name">Helium</div>
					<div class="pt-element-weight">4.003</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p2" id="li">
				<a href="/element/lithium-li">
					<div class="pt-element-number">3</div>
					<h2 class="pt-element-symbol">Li</h2>
					<div class="pt-element-name">Lithium</div>
					<div class="pt-element-weight">6.941</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p2" id="be">
				<a href="/element/beryllium-be">
					<div class="pt-element-number">4</div>
					<h2 class="pt-element-symbol">Be</h2>
					<div class="pt-element-name">Beryllium</div>
					<div class="pt-element-weight">9.012</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g13 p2" id="b">
				<a href="/element/boron-b">
					<div class="pt-element-number">5</div>
					<h2 class="pt-element-symbol">B</h2>
					<div class="pt-element-name">Boron</div>
					<div class="pt-element-weight">10.81</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-solid g14 p2" id="c">
				<a href="/element/carbon-c">
					<div class="pt-element-number">6</div>
					<h2 class="pt-element-symbol">C</h2>
					<div class="pt-element-name">Carbon</div>
					<div class="pt-element-weight">12.01</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-gas g15 p2" id="n">
				<a href="/element/nitrogen-n">
					<div class="pt-element-number">7</div>
					<h2 class="pt-element-symbol">N</h2>
					<div class="pt-element-name">Nitrogen</div>
					<div class="pt-element-weight">14.01</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-gas g16 p2" id="o">
				<a href="/element/oxygen-o">
					<div class="pt-element-number">8</div>
					<h2 class="pt-element-symbol">O</h2>
					<div class="pt-element-name">Oxygen</div>
					<div class="pt-element-weight">16.00</div>
				</a>
			</section>
			<section class="pt-element pt-halogen pt-gas g17 p2" id="f">
				<a href="/element/fluorine-f">
					<div class="pt-element-number">9</div>
					<h2 class="pt-element-symbol">F</h2>
					<div class="pt-element-name">Fluorine</div>
					<div class="pt-element-weight">19.00</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p2" id="ne">
				<a href="/element/neon-ne">
					<div class="pt-element-number">10</div>
					<h2 class="pt-element-symbol">Ne</h2>
					<div class="pt-element-name">Neon</div>
					<div class="pt-element-weight">20.18</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p3" id="na">
				<a href="/element/sodium-na">
					<div class="pt-element-number">11</div>
					<h2 class="pt-element-symbol">Na</h2>
					<div class="pt-element-name">Sodium</div>
					<div class="pt-element-weight">22.99</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p3" id="mg">
				<a href="/element/magnesium-mg">
					<div class="pt-element-number">12</div>
					<h2 class="pt-element-symbol">Mg</h2>
					<div class="pt-element-name">Magnesium</div>
					<div class="pt-element-weight">24.31</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g13 p3" id="al">
				<a href="/element/aluminum-al">
					<div class="pt-element-number">13</div>
					<h2 class="pt-element-symbol">Al</h2>
					<div class="pt-element-name">Aluminum</div>
					<p class="pt-element-weight">26.98</p>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g14 p3" id="si">
				<a href="/element/silicon-si">
					<div class="pt-element-number">14</div>
					<h2 class="pt-element-symbol">Si</h2>
					<div class="pt-element-name">Silicon</div>
					<div class="pt-element-weight">28.09</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-solid g15 p3" id="p">
				<a href="/element/phosphorus-p">
					<div class="pt-element-number">15</div>
					<h2 class="pt-element-symbol">P</h2>
					<div class="pt-element-name">Phosphorus</div>
					<div class="pt-element-weight">30.97</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-solid g16 p3" id="s">
				<a href="/element/sulfur-s">
					<div class="pt-element-number">16</div>
					<h2 class="pt-element-symbol">S</h2>
					<div class="pt-element-name">Sulfur</div>
					<div class="pt-element-weight">32.07</div>
				</a>
			</section>
			<section class="pt-element pt-halogen pt-gas g17 p3" id="cl">
				<a href="/element/chlorine-cl">
					<div class="pt-element-number">17</div>
					<h2 class="pt-element-symbol">Cl</h2>
					<div class="pt-element-name">Chlorine</div>
					<div class="pt-element-weight">35.45</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p3" id="ar">
				<a href="/element/argon-ar">
					<div class="pt-element-number">18</div>
					<h2 class="pt-element-symbol">Ar</h2>
					<div class="pt-element-name">Argon</div>
					<div class="pt-element-weight">39.95</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p4" id="k">
				<a href="/element/potassium-k">
					<div class="pt-element-number">19</div>
					<h2 class="pt-element-symbol">K</h2>
					<div class="pt-element-name">Potassium</div>
					<div class="pt-element-weight">39.10</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p4" id="ca">
				<a href="/element/calcium-ca">
					<div class="pt-element-number">20</div>
					<h2 class="pt-element-symbol">Ca</h2>
					<div class="pt-element-name">Calcium</div>
					<div class="pt-element-weight">40.08</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g3 p4" id="sc">
				<a href="/element/scandium-sc">
					<div class="pt-element-number">21</div>
					<h2 class="pt-element-symbol">Sc</h2>
					<div class="pt-element-name">Scandium</div>
					<div class="pt-element-weight">44.96</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g4 p4" id="ti">
				<a href="/element/titanium-ti">
					<div class="pt-element-number">22</div>
					<h2 class="pt-element-symbol">Ti</h2>
					<div class="pt-element-name">Titanium</div>
					<div class="pt-element-weight">47.87</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g5 p4" id="v">
				<a href="/element/vanadium-v">
					<div class="pt-element-number">23</div>
					<h2 class="pt-element-symbol">V</h2>
					<div class="pt-element-name">Vanadium</div>
					<div class="pt-element-weight">50.94</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g6 p4" id="cr">
				<a href="/element/chromium-cr">
					<div class="pt-element-number">24</div>
					<h2 class="pt-element-symbol">Cr</h2>
					<div class="pt-element-name">Chromium</div>
					<div class="pt-element-weight">52.00</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g7 p4" id="mn">
				<a href="/element/manganese-mn">
					<div class="pt-element-number">25</div>
					<h2 class="pt-element-symbol">Mn</h2>
					<div class="pt-element-name">Manganese</div>
					<div class="pt-element-weight">54.94</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g8 p4" id="fe">
				<a href="/element/iron-fe">
					<div class="pt-element-number">26</div>
					<h2 class="pt-element-symbol">Fe</h2>
					<div class="pt-element-name">Iron</div>
					<div class="pt-element-weight">55.85</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g9 p4" id="co">
				<a href="/element/cobalt-co">
					<div class="pt-element-number">27</div>
					<h2 class="pt-element-symbol">Co</h2>
					<div class="pt-element-name">Cobalt</div>
					<div class="pt-element-weight">58.93</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g10 p4" id="ni">
				<a href="/element/nickel-ni">
					<div class="pt-element-number">28</div>
					<h2 class="pt-element-symbol">Ni</h2>
					<div class="pt-element-name">Nickel</div>
					<div class="pt-element-weight">58.69</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g11 p4" id="cu">
				<a href="/element/copper-cu">
					<div class="pt-element-number">29</div>
					<h2 class="pt-element-symbol">Cu</h2>
					<div class="pt-element-name">Copper</div>
					<div class="pt-element-weight">63.55</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g12 p4" id="zn">
				<a href="/element/zinc-zn">
					<div class="pt-element-number">30</div>
					<h2 class="pt-element-symbol">Zn</h2>
					<div class="pt-element-name">Zinc</div>
					<div class="pt-element-weight">65.38</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g13 p4" id="ga">
				<a href="/element/gallium-ga">
					<div class="pt-element-number">31</div>
					<h2 class="pt-element-symbol">Ga</h2>
					<div class="pt-element-name">Gallium</div>
					<div class="pt-element-weight">69.72</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g14 p4" id="ge">
				<a href="/element/germanium-ge">
					<div class="pt-element-number">32</div>
					<h2 class="pt-element-symbol">Ge</h2>
					<div class="pt-element-name">Germanium</div>
					<div class="pt-element-weight">72.63</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g15 p4" id="as">
				<a href="/element/arsenic-as">
					<div class="pt-element-number">33</div>
					<h2 class="pt-element-symbol">As</h2>
					<div class="pt-element-name">Arsenic</div>
					<div class="pt-element-weight">74.92</div>
				</a>
			</section>
			<section class="pt-element pt-nonmetal pt-solid g16 p4" id="se">
				<a href="/element/selenium-se">
					<div class="pt-element-number">34</div>
					<h2 class="pt-element-symbol">Se</h2>
					<div class="pt-element-name">Selenium</div>
					<div class="pt-element-weight">78.97</div>
				</a>
			</section>
			<section class="pt-element pt-halogen pt-liquid g17 p4" id="br">
				<a href="/element/bromine-br">
					<div class="pt-element-number">35</div>
					<h2 class="pt-element-symbol">Br</h2>
					<div class="pt-element-name">Bromine</div>
					<div class="pt-element-weight">79.90</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p4" id="kr">
				<a href="/element/krypton-kr">
					<div class="pt-element-number">36</div>
					<h2 class="pt-element-symbol">Kr</h2>
					<div class="pt-element-name">Krypton</div>
					<div class="pt-element-weight">83.80</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p5" id="rb">
				<a href="/element/rubidium-rb">
					<div class="pt-element-number">37</div>
					<h2 class="pt-element-symbol">Rb</h2>
					<div class="pt-element-name">Rubidium</div>
					<div class="pt-element-weight">85.47</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p5" id="sr">
				<a href="/element/strontium-sr">
					<div class="pt-element-number">38</div>
					<h2 class="pt-element-symbol">Sr</h2>
					<div class="pt-element-name">Strontium</div>
					<div class="pt-element-weight">87.62</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g3 p5" id="y">
				<a href="/element/yttrium-y">
					<div class="pt-element-number">39</div>
					<h2 class="pt-element-symbol">Y</h2>
					<div class="pt-element-name">Yttrium</div>
					<div class="pt-element-weight">88.91</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g4 p5" id="zr">
				<a href="/element/zirconium-zr">
					<div class="pt-element-number">40</div>
					<h2 class="pt-element-symbol">Zr</h2>
					<div class="pt-element-name">Zirconium</div>
					<div class="pt-element-weight">91.22</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g5 p5" id="nb">
				<a href="/element/niobium-nb">
					<div class="pt-element-number">41</div>
					<h2 class="pt-element-symbol">Nb</h2>
					<div class="pt-element-name">Niobium</div>
					<div class="pt-element-weight">92.91</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g6 p5" id="mo">
				<a href="/element/molybdenum-mo">
					<div class="pt-element-number">42</div>
					<h2 class="pt-element-symbol">Mo</h2>
					<div class="pt-element-name">Molybdenum</div>
					<div class="pt-element-weight">95.95</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g7 p5" id="tc">
				<a href="/element/technetium-tc">
					<div class="pt-element-number">43</div>
					<h2 class="pt-element-symbol">Tc</h2>
					<div class="pt-element-name">Technetium</div>
					<div class="pt-element-weight">98.00</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g8 p5" id="ru">
				<a href="/element/ruthenium-ru">
					<div class="pt-element-number">44</div>
					<h2 class="pt-element-symbol">Ru</h2>
					<div class="pt-element-name">Ruthenium</div>
					<div class="pt-element-weight">101.1</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g9 p5" id="rh">
				<a href="/element/rhodium-rh">
					<div class="pt-element-number">45</div>
					<h2 class="pt-element-symbol">Rh</h2>
					<div class="pt-element-name">Rhodium</div>
					<div class="pt-element-weight">102.9</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g10 p5" id="pd">
				<a href="/element/palladium-pd">
					<div class="pt-element-number">46</div>
					<h2 class="pt-element-symbol">Pd</h2>
					<div class="pt-element-name">Palladium</div>
					<div class="pt-element-weight">106.4</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g11 p5" id="ag">
				<a href="/element/silver-ag">
					<div class="pt-element-number">47</div>
					<h2 class="pt-element-symbol">Ag</h2>
					<div class="pt-element-name">Silver</div>
					<div class="pt-element-weight">107.9</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g12 p5" id="cd">
				<a href="/element/cadmium-cd">
					<div class="pt-element-number">48</div>
					<h2 class="pt-element-symbol">Cd</h2>
					<div class="pt-element-name">Cadmium</div>
					<div class="pt-element-weight">112.4</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g13 p5" id="in">
				<a href="/element/indium-in">
					<div class="pt-element-number">49</div>
					<h2 class="pt-element-symbol">In</h2>
					<div class="pt-element-name">Indium</div>
					<div class="pt-element-weight">114.8</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g14 p5" id="sn">
				<a href="/element/tin-sn">
					<div class="pt-element-number">50</div>
					<h2 class="pt-element-symbol">Sn</h2>
					<div class="pt-element-name">Tin</div>
					<div class="pt-element-weight">118.7</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g15 p5" id="sb">
				<a href="/element/antimony-sb">
					<div class="pt-element-number">51</div>
					<h2 class="pt-element-symbol">Sb</h2>
					<div class="pt-element-name">Antimony</div>
					<div class="pt-element-weight">121.8</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-metalloids pt-solid g16 p5" id="te">
				<a href="/element/tellurium-te">
					<div class="pt-element-number">52</div>
					<h2 class="pt-element-symbol">Te</h2>
					<div class="pt-element-name">Tellurium</div>
					<div class="pt-element-weight">127.6</div>
				</a>
			</section>
			<section class="pt-element pt-halogen pt-solid g17 p5" id="i">
				<a href="/element/iodine-i">
					<div class="pt-element-number">53</div>
					<h2 class="pt-element-symbol">I</h2>
					<div class="pt-element-name">Iodine</div>
					<div class="pt-element-weight">126.9</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p5" id="xe">
				<a href="/element/xenon-xe">
					<div class="pt-element-number">54</div>
					<h2 class="pt-element-symbol">Xe</h2>
					<div class="pt-element-name">Xenon</div>
					<div class="pt-element-weight">131.3</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p6" id="cs">
				<a href="/element/cesium-cs">
					<div class="pt-element-number">55</div>
					<h2 class="pt-element-symbol">Cs</h2>
					<div class="pt-element-name">Cesium</div>
					<div class="pt-element-weight">132.9</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p6" id="ba">
				<a href="/element/barium-ba">
					<div class="pt-element-number">56</div>
					<h2 class="pt-element-symbol">Ba</h2>
					<div class="pt-element-name">Barium</div>
					<div class="pt-element-weight">137.3</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="la">
				<a href="/element/lanthanum-la">
					<div class="pt-element-number">57</div>
					<h2 class="pt-element-symbol">La</h2>
					<div class="pt-element-name">Lanthanum</div>
					<div class="pt-element-weight">138.9</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="ce">
				<a href="/element/cerium-ce">
					<div class="pt-element-number">58</div>
					<h2 class="pt-element-symbol">Ce</h2>
					<div class="pt-element-name">Cerium</div>
					<div class="pt-element-weight">140.1</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="pr">
				<a href="/element/praseodymium-pr">
					<div class="pt-element-number">59</div>
					<h2 class="pt-element-symbol">Pr</h2>
					<div class="pt-element-name">Praseodymium</div>
					<div class="pt-element-weight">140.9</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="nd">
				<a href="/element/neodymium-nd">
					<div class="pt-element-number">60</div>
					<h2 class="pt-element-symbol">Nd</h2>
					<div class="pt-element-name">Neodymium</div>
					<div class="pt-element-weight">144.2</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="pm">
				<a href="/element/promethium-pm">
					<div class="pt-element-number">61</div>
					<h2 class="pt-element-symbol">Pm</h2>
					<div class="pt-element-name">Promethium</div>
					<div class="pt-element-weight">145</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="sm">
				<a href="/element/samarium-sm">
					<div class="pt-element-number">62</div>
					<h2 class="pt-element-symbol">Sm</h2>
					<div class="pt-element-name">Samarium</div>
					<div class="pt-element-weight">150.4</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="eu">
				<a href="/element/europium-eu">
					<div class="pt-element-number">63</div>
					<h2 class="pt-element-symbol">Eu</h2>
					<div class="pt-element-name">Europium</div>
					<div class="pt-element-weight">152.00</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="gd">
				<a href="/element/gadolinium-gd">
					<div class="pt-element-number">64</div>
					<h2 class="pt-element-symbol">Gd</h2>
					<div class="pt-element-name">Gadolinium</div>
					<div class="pt-element-weight">157.3</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="tb">
				<a href="/element/terbium-tb">
					<div class="pt-element-number">65</div>
					<h2 class="pt-element-symbol">Tb</h2>
					<div class="pt-element-name">Terbium</div>
					<div class="pt-element-weight">158.9</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="dy">
				<a href="/element/dysprosium-dy">
					<div class="pt-element-number">66</div>
					<h2 class="pt-element-symbol">Dy</h2>
					<div class="pt-element-name">Dysprosium</div>
					<div class="pt-element-weight">162.5</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="ho">
				<a href="/element/holmium-ho">
					<div class="pt-element-number">67</div>
					<h2 class="pt-element-symbol">Ho</h2>
					<div class="pt-element-name">Holmium</div>
					<div class="pt-element-weight">164.9</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="er">
				<a href="/element/erbium-er">
					<div class="pt-element-number">68</div>
					<h2 class="pt-element-symbol">Er</h2>
					<div class="pt-element-name">Erbium</div>
					<div class="pt-element-weight">167.3</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="tm">
				<a href="/element/thulium-tm">
					<div class="pt-element-number">69</div>
					<h2 class="pt-element-symbol">Tm</h2>
					<div class="pt-element-name">Thulium</div>
					<div class="pt-element-weight">168.9</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="yb">
				<a href="/element/ytterbium-yb">
					<div class="pt-element-number">70</div>
					<h2 class="pt-element-symbol">Yb</h2>
					<div class="pt-element-name">Ytterbium</div>
					<div class="pt-element-weight">173.04</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide pt-solid p6" id="lu">
				<a href="/element/lutetium-lu">
					<div class="pt-element-number">71</div>
					<h2 class="pt-element-symbol">Lu</h2>
					<div class="pt-element-name">Lutetium</div>
					<div class="pt-element-weight">175.00</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g4 p6" id="hf">
				<a href="/element/hafnium-hf">
					<div class="pt-element-number">72</div>
					<h2 class="pt-element-symbol">Hf</h2>
					<div class="pt-element-name">Hafnium</div>
					<div class="pt-element-weight">178.5</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g5 p6" id="ta">
				<a href="/element/tantalum-ta">
					<div class="pt-element-number">73</div>
					<h2 class="pt-element-symbol">Ta</h2>
					<div class="pt-element-name">Tantalum</div>
					<div class="pt-element-weight">180.9</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g6 p6" id="w">
				<a href="/element/tungsten-w">
					<div class="pt-element-number">74</div>
					<h2 class="pt-element-symbol">W</h2>
					<div class="pt-element-name">Tungsten</div>
					<div class="pt-element-weight">183.8</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g7 p6" id="re">
				<a href="/element/rhenium-re">
					<div class="pt-element-number">75</div>
					<h2 class="pt-element-symbol">Re</h2>
					<div class="pt-element-name">Rhenium</div>
					<div class="pt-element-weight">186.2</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g8 p6" id="os">
				<a href="/element/osmium-os">
					<div class="pt-element-number">76</div>
					<h2 class="pt-element-symbol">Os</h2>
					<div class="pt-element-name">Osmium</div>
					<div class="pt-element-weight">190.2</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g9 p6" id="ir">
				<a href="/element/iridium-ir">
					<div class="pt-element-number">77</div>
					<h2 class="pt-element-symbol">Ir</h2>
					<div class="pt-element-name">Iridium</div>
					<div class="pt-element-weight">192.2</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g10 p6" id="pt">
				<a href="/element/platinum-pt">
					<div class="pt-element-number">78</div>
					<h2 class="pt-element-symbol">Pt</h2>
					<div class="pt-element-name">Platinum</div>
					<div class="pt-element-weight">195.1</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-solid g11 p6" id="au">
				<a href="/element/gold-au">
					<div class="pt-element-number">79</div>
					<h2 class="pt-element-symbol">Au</h2>
					<div class="pt-element-name">Gold</div>
					<div class="pt-element-weight">197.00</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-liquid g12 p6" id="hg">
				<a href="/element/mercury-hg">
					<div class="pt-element-number">80</div>
					<h2 class="pt-element-symbol">Hg</h2>
					<div class="pt-element-name">Mercury</div>
					<div class="pt-element-weight">200.6</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g13 p6" id="tl">
				<a href="/element/thallium-tl">
					<div class="pt-element-number">81</div>
					<h2 class="pt-element-symbol">Tl</h2>
					<div class="pt-element-name">Thallium</div>
					<div class="pt-element-weight">204.4</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g14 p6" id="pb">
				<a href="/element/lead-pb">
					<div class="pt-element-number">82</div>
					<h2 class="pt-element-symbol">Pb</h2>
					<div class="pt-element-name">Lead</div>
					<div class="pt-element-weight">207.2</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g15 p6" id="bi">
				<a href="/element/bismuth-bi">
					<div class="pt-element-number">83</div>
					<h2 class="pt-element-symbol">Bi</h2>
					<div class="pt-element-name">Bismuth</div>
					<div class="pt-element-weight">209.00</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition pt-solid g16 p6" id="po">
				<a href="/element/polonium-po">
					<div class="pt-element-number">84</div>
					<h2 class="pt-element-symbol">Po</h2>
					<div class="pt-element-name">Polonium</div>
					<div class="pt-element-weight">(209)</div>
				</a>
			</section>
			<section class="pt-element pt-semimetal pt-solid pt-metalloids g17 p6" id="at">
				<a href="/element/astatine-at">
					<div class="pt-element-number">85</div>
					<h2 class="pt-element-symbol">At</h2>
					<div class="pt-element-name">Astatine</div>
					<div class="pt-element-weight">(210)</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-gas g18 p6" id="rn">
				<a href="/element/radon-rn">
					<div class="pt-element-number">86</div>
					<h2 class="pt-element-symbol">Rn</h2>
					<div class="pt-element-name">Radon</div>
					<div class="pt-element-weight">(222)</div>
				</a>
			</section>
			<section class="pt-element pt-alkali pt-solid g1 p7" id="fr">
				<a href="/element/francium-fr">
					<div class="pt-element-number">87</div>
					<h2 class="pt-element-symbol">Fr</h2>
					<div class="pt-element-name">Francium</div>
					<div class="pt-element-weight">(223)</div>
				</a>
			</section>
			<section class="pt-element pt-alkaline pt-solid g2 p7" id="ra">
				<a href="/element/radium-ra">
					<div class="pt-element-number">88</div>
					<h2 class="pt-element-symbol">Ra</h2>
					<div class="pt-element-name">Radium</div>
					<div class="pt-element-weight">(226)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="ac">
				<a href="/element/actinium-ac">
					<div class="pt-element-number">89</div>
					<h2 class="pt-element-symbol">Ac</h2>
					<div class="pt-element-name">Actinium</div>
					<div class="pt-element-weight">(227)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="th">
				<a href="/element/thorium-th">
					<div class="pt-element-number">90</div>
					<h2 class="pt-element-symbol">Th</h2>
					<div class="pt-element-name">Thorium</div>
					<div class="pt-element-weight">232</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="pa">
				<a href="/element/protactinium-pa">
					<div class="pt-element-number">91</div>
					<h2 class="pt-element-symbol">Pa</h2>
					<div class="pt-element-name">Protactinium</div>
					<div class="pt-element-weight">231.00</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="u">
				<a href="/element/uranium-u">
					<div class="pt-element-number">92</div>
					<h2 class="pt-element-symbol">U</h2>
					<div class="pt-element-name">Uranium</div>
					<div class="pt-element-weight">238.00</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="np">
				<a href="/element/neptunium-np">
					<div class="pt-element-number">93</div>
					<h2 class="pt-element-symbol">Np</h2>
					<div class="pt-element-name">Neptunium</div>
					<div class="pt-element-weight">(237)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="pu">
				<a href="/element/plutonium-pu">
					<div class="pt-element-number">94</div>
					<h2 class="pt-element-symbol">Pu</h2>
					<div class="pt-element-name">Plutonium</div>
					<div class="pt-element-weight">(244)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="am">
				<a href="/element/americium-am">
					<div class="pt-element-number">95</div>
					<h2 class="pt-element-symbol">Am</h2>
					<div class="pt-element-name">Americium</div>
					<div class="pt-element-weight">(243)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="cm">
				<a href="/element/curium-cm">
					<div class="pt-element-number">96</div>
					<h2 class="pt-element-symbol">Cm</h2>
					<div class="pt-element-name">Curium</div>
					<div class="pt-element-weight">(247)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="bk">
				<a href="/element/berkelium-bk">
					<div class="pt-element-number">97</div>
					<h2 class="pt-element-symbol">Bk</h2>
					<div class="pt-element-name">Berkelium</div>
					<div class="pt-element-weight">(247)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="cf">
				<a href="/element/californium-cf">
					<div class="pt-element-number">98</div>
					<h2 class="pt-element-symbol">Cf</h2>
					<div class="pt-element-name">Californium</div>
					<div class="pt-element-weight">(251)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="es">
				<a href="/element/einsteinium-es">
					<div class="pt-element-number">99</div>
					<h2 class="pt-element-symbol">Es</h2>
					<div class="pt-element-name">Einsteinium</div>
					<div class="pt-element-weight">(252)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="fm">
				<a href="/element/fermium-fm">
					<div class="pt-element-number">100</div>
					<h2 class="pt-element-symbol">Fm</h2>
					<div class="pt-element-name">Fermium</div>
					<div class="pt-element-weight">(257)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="md">
				<a href="/element/mendelevium-md">
					<div class="pt-element-number">101</div>
					<h2 class="pt-element-symbol">Md</h2>
					<div class="pt-element-name">Mendelevium</div>
					<div class="pt-element-weight">(258)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="no">
				<a href="/element/nobelium-no">
					<div class="pt-element-number">102</div>
					<h2 class="pt-element-symbol">No</h2>
					<div class="pt-element-name">Nobelium</div>
					<div class="pt-element-weight">(259)</div>
				</a>
			</section>
			<section class="pt-element pt-actinide pt-solid p7" id="lr">
				<a href="/element/lawrencium-lr">
					<div class="pt-element-number">103</div>
					<h2 class="pt-element-symbol">Lr</h2>
					<div class="pt-element-name">Lawrencium</div>
					<div class="pt-element-weight">(262)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g4 p7" id="rf">
				<a href="/element/rutherfordium-rf">
					<div class="pt-element-number">104</div>
					<h2 class="pt-element-symbol">Rf</h2>
					<div class="pt-element-name">Rutherfordium</div>
					<div class="pt-element-weight">(267)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g5 p7" id="db">
				<a href="/element/dubnium-db">
					<div class="pt-element-number">105</div>
					<h2 class="pt-element-symbol">Db</h2>
					<div class="pt-element-name">Dubnium</div>
					<div class="pt-element-weight">(268)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g6 p7" id="sg">
				<a href="/element/seaborgium-sg">
					<div class="pt-element-number">106</div>
					<h2 class="pt-element-symbol">Sg</h2>
					<div class="pt-element-name">Seaborgium</div>
					<div class="pt-element-weight">(269)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g7 p7" id="bh">
				<a href="/element/bohrium-bh">
					<div class="pt-element-number">107</div>
					<h2 class="pt-element-symbol">Bh</h2>
					<div class="pt-element-name">Bohrium</div>
					<div class="pt-element-weight">(270)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g8 p7" id="hs">
				<a href="/element/hassium-hs">
					<div class="pt-element-number">108</div>
					<h2 class="pt-element-symbol">Hs</h2>
					<div class="pt-element-name">Hassium</div>
					<div class="pt-element-weight">(269)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g9 p7" id="mt">
				<a href="/element/meitnerium-mt">
					<div class="pt-element-number">109</div>
					<h2 class="pt-element-symbol">Mt</h2>
					<div class="pt-element-name">Meitnerium</div>
					<div class="pt-element-weight">(278)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g10 p7" id="ds">
				<a href="/element/darmstadtium-ds">
					<div class="pt-element-number">110</div>
					<h2 class="pt-element-symbol">Ds</h2>
					<div class="pt-element-name">Darmstadtium</div>
					<div class="pt-element-weight">(281)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g11 p7" id="rg">
				<a href="/element/roentgenium-rg">
					<div class="pt-element-number">111</div>
					<h2 class="pt-element-symbol">Rg</h2>
					<div class="pt-element-name">Roentgenium</div>
					<div class="pt-element-weight">(281)</div>
				</a>
			</section>
			<section class="pt-element pt-transition pt-unknown g12 p7" id="cn">
				<a href="/element/copernicium-cn">
					<div class="pt-element-number">112</div>
					<h2 class="pt-element-symbol">Cn</h2>
					<div class="pt-element-name">Copernicium</div>
					<div class="pt-element-weight">(285)</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition g13 p7" id="nh">
				<a href="/element/nihonium-nh">
					<div class="pt-element-number">113</div>
					<h2 class="pt-element-symbol">Nh</h2>
					<div class="pt-element-name">Nihonium</div>
					<div class="pt-element-weight">(286)</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition g14 p7" id="fl">
				<a href="/element/flerovium-fl">
					<div class="pt-element-number">114</div>
					<h2 class="pt-element-symbol">Fl</h2>
					<div class="pt-element-name">Flerovium</div>
					<div class="pt-element-weight">(289)</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition g15 p7" id="mc">
				<a href="/element/moscovium-mc">
					<div class="pt-element-number">115</div>
					<h2 class="pt-element-symbol">Mc</h2>
					<div class="pt-element-name">Moscovium</div>
					<div class="pt-element-weight">(289)</div>
				</a>
			</section>
			<section class="pt-element pt-basic pt-post-transition g16 p7" id="lv">
				<a href="/element/livermorium-lv">
					<div class="pt-element-number">116</div>
					<h2 class="pt-element-symbol">Lv</h2>
					<div class="pt-element-name">Livermorium</div>
					<div class="pt-element-weight">(293)</div>
				</a>
			</section>
			<section class="pt-element pt-halogen pt-unknown g17 p7" id="ts">
				<a href="/element/tennessine-ts">
					<div class="pt-element-number">117</div>
					<h2 class="pt-element-symbol">Ts</h2>
					<div class="pt-element-name">Tennessine</div>
					<div class="pt-element-weight">(294)</div>
				</a>
			</section>
			<section class="pt-element pt-noble pt-unknown g18 p7" id="og">
				<a href="/element/oganesson-og">
					<div class="pt-element-number">118</div>
					<h2 class="pt-element-symbol">Og</h2>
					<div class="pt-element-name">Oganesson</div>
					<div class="pt-element-weight">(294)</div>
				</a>
			</section>
			<section class="pt-element pt-lanthanide" id="lan">
				<div class="pt-element-number">&nbsp;</div>
				<h2 class="pt-element-symbol">&nbsp;</h2>
				<div class="pt-element-name">Lanthanides</div>
			</section>
			<section class="pt-element pt-actinide" id="act">
				<div class="pt-element-number">&nbsp;</div>
				<h2 class="pt-element-symbol">&nbsp;</h2>
				<div class="pt-element-name">Actinides</div>
			</section>
		</div>
	</div>
</main><!-- #main -->

<?php get_footer();
