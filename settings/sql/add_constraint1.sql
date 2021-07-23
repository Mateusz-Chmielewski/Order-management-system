ALTER TABLE [dbo].[zlecenia]  WITH CHECK ADD  CONSTRAINT [FK_zlecenia_klienci] FOREIGN KEY([Klient])
REFERENCES [dbo].[klienci] ([ID_klienta])