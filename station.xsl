<?xml version="1.0"  encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxsl="urn:schemas-microsoft-com:xslt">

	<xsl:output method="html"
		indent="yes"
		media-type="text/html"
		omit-xml-declaration="yes"
		doctype-public="-//W3C//DTD HTML 5.00 Transitional//EN"
		doctype-system="http://www.w3.org/TR/html4/loose.dtd"
		encoding="ISO-8859-1"
	></xsl:output>

	<xsl:template match="/">			
		<script language="javascript"><xsl:apply-templates select="/carto/markers/marker"><xsl:sort select="@number" data-type="number" order="ascending"/></xsl:apply-templates></script>
	</xsl:template>

    <xsl:template match="marker">
			L.marker([<xsl:value-of select="@lat"/>, <xsl:value-of select="@lng"/>]).addTo(mymap).bindPopup("<xsl:value-of select='@name'/>"+'<iframe src="./description.php?id={@number}"></iframe>').openPopup();
    </xsl:template>

</xsl:stylesheet>

