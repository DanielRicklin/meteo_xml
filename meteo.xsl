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
		<h1>Prévisions Météo</h1>
		<xsl:apply-templates select="echeance" />
	</xsl:template>


	<xsl:template match="echeance">
		
		<xsl:element name="div">
			<p><b>DATE : </b><xsl:value-of select="@timestamp"/></p>
		</xsl:element>

		<!--  -->
		<table border="1">
			<h1>Tableau des températures</h1>
				<tr border="1">
					<td><b>2m au dessus du sol</b></td><td><b>Au sol</b></td><td><b>850hPa</b></td><td><b>500hPa</b></td>
				</tr>
				<xsl:apply-templates select="temperature" />
		</table>
		<!--  -->

		<xsl:apply-templates select="pluie" />
		<xsl:apply-templates select="humidite" />
		<xsl:apply-templates select="vent_moyen" />
		<xsl:apply-templates select="temperature/level" />

		<xsl:choose>
			<xsl:when test="risque_neige = 'non'">
				<p>Il n'y a pas de risque de neige</p>
			</xsl:when>
			<xsl:otherwise>
				<p>Il y a un risque de neige</p>
			</xsl:otherwise>
		</xsl:choose>

	</xsl:template>



	<!--  -->
	<xsl:template match="temperature">
		<tr>
			<!--<td><xsl:value-of select="level/@val"/></td>-->
			
		</tr>
	</xsl:template>
	<!--  -->

	<xsl:template match="temperature/level">
		<td><xsl:value-of select="*"/></td>
	</xsl:template>

	<!--  -->



	<xsl:template match="pression">
		<p>Pression (<xsl:value-of select="level/@val" />) : <xsl:value-of select="level" /></p>
	</xsl:template>

	<xsl:template match="pluie">
		<p>Intempéries relevées (sur une intervale de <xsl:value-of select="@interval" />) : <xsl:value-of select="pluie" /></p>
	</xsl:template>

	<xsl:template match="humidite">
		<p>Humidités relevées (sur une intervale de <xsl:value-of select="level/@val" />) : <xsl:value-of select="level" /></p>
	</xsl:template>

	<xsl:template match="vent_moyen">
		<p>Vents moyens relevées (sur une intervale de <xsl:value-of select="level/@val" />) : <xsl:value-of select="level" /></p>
	</xsl:template>

	<xsl:template match="vent_rafales">
		<p>Vents en rafales relevées (sur une intervale de <xsl:value-of select="level/@val" />) : <xsl:value-of select="level" /></p>
	</xsl:template>

	<xsl:template match="vent_direction">
		<p>Direction du vent relevées (sur une intervale de <xsl:value-of select="level/@val" />) : <xsl:value-of select="level" /></p>
	</xsl:template>

</xsl:stylesheet>

