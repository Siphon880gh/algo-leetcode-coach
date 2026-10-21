An ads table logs, per ad and user, whether the user clicked, viewed, or ignored the ad. Report each ad's click-through rate: clicks divided by clicks plus views, as a percentage, or 0 when there are neither. Rounding and output order follow the statement (typically two decimals, by rate descending, then ad id). _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Conditional sums

Using the column names the statement gives:

```sql
SELECT ad_id,
       ROUND(IFNULL(100 * SUM(action = 'Clicked')
                    / NULLIF(SUM(action IN ('Clicked', 'Viewed')), 0), 0), 2) AS ctr
FROM Ads
GROUP BY ad_id
ORDER BY ctr DESC, ad_id;
```

For instance, an ad with 2 clicks, 1 view, and 1 ignore has rate `2 / 3 · 100 ≈ 66.67`; an ad with only ignores has 0.

Do not count ignores in the denominator. Do not filter ignored rows out in `WHERE`; ads with only ignores would disappear instead of showing 0.

Time: O(n log n)  
Space: O(ads)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
