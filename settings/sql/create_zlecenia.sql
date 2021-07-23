CREATE TABLE [dbo].[zlecenia](
	[ID_zlecenia] [int] IDENTITY(1,1) NOT FOR REPLICATION NOT NULL,
	[Klient] [int] NOT NULL,
	[Data] [date] NULL,
	[Status] [nchar](20) NOT NULL,
	[Sprzet] [text] NOT NULL,
	[Opis] [text] NOT NULL,
	[Uwagi] [text] NULL,
	[Notatka] [text] NULL,
 CONSTRAINT [PK_zlecenia] PRIMARY KEY CLUSTERED 
(
	[ID_zlecenia] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]