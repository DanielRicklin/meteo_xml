<?xml version="1.0"  encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="html"
		indent="yes"
		media-type="text/html"
		omit-xml-declaration="yes"
		doctype-public="-//W3C//DTD HTML 5.00 Transitional//EN"
		doctype-system="http://www.w3.org/TR/html4/loose.dtd"
		encoding="ISO-8859-1"
	></xsl:output>

	<xsl:template match="/previsions">			
				<div id="mapid" style="width: 600px; height: 400px;"></div>
				<script type="text/javascript" src="./map.js"></script>
	</xsl:template>

</xsl:stylesheet>

