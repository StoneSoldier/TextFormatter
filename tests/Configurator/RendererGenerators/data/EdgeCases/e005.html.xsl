<?xml version="1.0" encoding="utf-8"?><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"><xsl:output method="html" encoding="utf-8" indent="no"/><xsl:template match="p"><p><xsl:apply-templates/></p></xsl:template><xsl:template match="br"><br/></xsl:template><xsl:template match="e|i|s"/><xsl:template match="B"><b><xsl:apply-templates/></b></xsl:template><xsl:template match="T2"><b><xsl:apply-templates select="I"/></b></xsl:template><xsl:template match="I"><i><xsl:apply-templates/></i></xsl:template></xsl:stylesheet>