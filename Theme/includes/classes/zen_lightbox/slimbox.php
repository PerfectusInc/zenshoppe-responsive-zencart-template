<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: slimbox.php 2008-12-15 aclarke $
 */

echo '<script type="text/javascript" src="' . $template->get_template_dir('.js', DIR_WS_TEMPLATE, $current_page_base, 'jscript') . '/jquery-1.4.4.min.js"></script>';
?>

<script language="javascript" type="text/javascript"><!--
/*
	Slimbox v2.04 - The ultimate lightweight Lightbox clone for jQuery
	(c) 2007-2010 Christophe Beyls <http://www.digitalia.be>
	MIT-style license.
*/
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(3(w){5 E=w(18),u,f,F=-1,n,x,D,v,y,L,r,m=!18.23,s=[],l=1r.24,k={},t=1f 19(),J=1f 19(),H,a,g,p,I,d,G,c,A,K;w(3(){w("25").1a(w([H=w(\'<Z 9="26" />\').12(C)[0],a=w(\'<Z 9="28" />\')[0],G=w(\'<Z 9="29" />\')[0]]).6("16","1s"));g=w(\'<Z 9="1t" />\').1u(a).1a(p=w(\'<Z 11="1g: 2a;" />\').1a([I=w(\'<a 9="2b" 1b="#" />\').12(B)[0],d=w(\'<a 9="2c" 1b="#" />\').12(e)[0]])[0])[0];c=w(\'<Z 9="2d" />\').1u(G).1a([w(\'<a 9="2e" 1b="#" />\').12(C)[0],A=w(\'<Z 9="2f" />\')[0],K=w(\'<Z 9="2g" />\')[0],w(\'<Z 11="2h: 2i;" />\')[0]])[0]});w.1h=3(O,N,M){u=w.2j({17:1i,1v:0.8,1j:1c,1k:1c,1l:"2k",1w:1x,1y:1x,1z:1c,1A:1c,1B:"19 {x} 2l {y}",1C:[27,2m,2n],1D:[2o,2p],1E:[2q,2r]},M);4(2s O=="2t"){O=[[O,N]];N=0}y=E.1F()+(E.X()/2);L=u.1w;r=u.1y;w(a).6({1d:1G.1H(0,y-(r/2)),Y:L,X:r,1m:-L/2}).1n();v=m||(H.1I&&(H.1I.1g!="2u"));4(v){H.11.1g="2v"}w(H).6("1J",u.1v).1K(u.1j);z();j(1);f=O;u.17=u.17&&(f.13>1);7 b(N)};w.2w.1h=3(M,P,O){P=P||3(Q){7[Q.1b,Q.2x]};O=O||3(){7 1L};5 N=1M;7 N.1N("12").12(3(){5 S=1M,U=0,T,Q=0,R;T=w.2y(N,3(W,V){7 O.2z(S,W,V)});2A(R=T.13;Q<R;++Q){4(T[Q]==S){U=Q}T[Q]=P(T[Q],Q)}7 w.1h(T,U,M)})};3 z(){5 N=E.2B(),M=E.Y();w([a,G]).6("1O",N+(M/2));4(v){w(H).6({1O:N,1d:E.1F(),Y:M,X:E.X()})}}3 j(M){4(M){w("2C").2D(m?"2E":"2F").1P(3(O,P){s[O]=[P,P.11.10];P.11.10="1e"})}1o{w.1P(s,3(O,P){P[0].11.10=P[1]});s=[]}5 N=M?"2G":"1N";E[N]("2H 2I",z);w(1r)[N]("2J",o)}3 o(O){5 N=O.2K,M=w.2L;7(M(N,u.1C)>=0)?C():(M(N,u.1E)>=0)?e():(M(N,u.1D)>=0)?B():1Q}3 B(){7 b(x)}3 e(){7 b(D)}3 b(M){4(M>=0){F=M;n=f[F][0];x=(F||(u.17?f.13:0))-1;D=((F+1)%f.13)||(u.17?0:-1);q();a.1R="2M";k=1f 19();k.1S=i;k.14=n}7 1i}3 i(){a.1R="";5 b=18.2N-15;5 c=18.2O-20;5 e=(b>c)?c:b;5 j=k.Y;5 l=k.X;4(j>l){l=e*l/j;j=e}1o{j=e*j/l;l=e}4(k.Y>j||k.X>l){$(g).6({1T:"1U("+n+")",2P:""+j+"1V "+l+"1V",10:"1e",16:"2Q"});$(p).Y(j);$([p,I,d]).X(l)}1o{$(g).6({1T:"1U("+n+")",10:"1e",16:""});$(p).Y(k.Y);$([p,I,d]).X(k.X)}$(\'#1t\').6(\'2R-2S\',\'2T\');w(A).1W(f[F][1]||"");w(K).1W((((f.13>1)&&u.1B)||"").1X(/{x}/,F+1).1X(/{y}/,f.13));4(x>=0){t.14=f[x][0]}4(D>=0){J.14=f[D][0]}L=g.1Y;r=g.1p;5 M=1G.1H(0,y-(r/2));4(a.1p!=r){w(a).1q({X:r,1d:M},u.1k,u.1l)}4(a.1Y!=L){w(a).1q({Y:L,1m:-L/2},u.1k,u.1l)}w(a).2U(3(){w(G).6({Y:L,1d:M+r,1m:-L/2,10:"1e",16:""});w(g).6({16:"1s",10:"",1J:""}).1K(u.1z,h)})}3 h(){4(x>=0){w(I).1n()}4(D>=0){w(d).1n()}w(c).6("1Z",-c.1p).1q({1Z:0},u.1A);G.11.10=""}3 q(){k.1S=1Q;k.14=t.14=J.14=n;w([a,g,c]).21(1L);w([I,d,g,G]).22()}3 C(){4(F>=0){q();F=x=D=-1;w(a).22();w(H).21().2V(u.1j,j)}7 1i}})(2W);',62,183,'|||function|if|var|css|return||id||||||||||||||||||||||||||||||||||||||||||||||||||height|width|div|visibility|style|click|length|src||display|loop|window|Image|append|href|400|top|hidden|new|position|slimbox|false|overlayFadeDuration|resizeDuration|resizeEasing|marginLeft|show|else|offsetHeight|animate|document|none|lbImage|appendTo|overlayOpacity|initialWidth|250|initialHeight|imageFadeDuration|captionAnimationDuration|counterText|closeKeys|previousKeys|nextKeys|scrollTop|Math|max|currentStyle|opacity|fadeIn|true|this|unbind|left|each|null|className|onload|backgroundImage|url|px|html|replace|offsetWidth|marginTop||stop|hide|XMLHttpRequest|documentElement|body|lbOverlay||lbCenter|lbBottomContainer|relative|lbPrevLink|lbNextLink|lbBottom|lbCloseLink|lbCaption|lbNumber|clear|both|extend|swing|of|88|67|37|80|39|78|typeof|string|fixed|absolute|fn|title|grep|call|for|scrollLeft|object|add|select|embed|bind|scroll|resize|keydown|which|inArray|lbLoading|innerWidth|innerHeight|backgroundSize|block|background|size|contain|queue|fadeOut|jQuery'.split('|'),0,{}))
// AUTOLOAD CODE BLOCK (MAY BE CHANGED OR REMOVED)
if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
	jQuery(function($) {
		$("a[rel^='lightbox']").slimbox({/* Put custom options here */
		
				loop: false,
				initialWidth: 100, //1024
				initialHeight: 100, //768
				overlayOpacity: 0.8,
				overlayFadeDuration: 800,
				resizeDuration: 400,
				resizeEasing: "easeOutElastic",
				imageFadeDuration: 400,
				counterText: "<strong>{x}</strong> of <strong>{y}</strong>",
				previousKeys: [37, 80, 16],
				nextKeys: [39, 78, 17],
				closeKeys: [27, 70],
				captionAnimationDuration: 0,
		
		}, null, function(el) {
			return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
		});
	});
}