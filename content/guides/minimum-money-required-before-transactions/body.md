## Lose everything, then need one more

1. `loss = Σ (cost − cashback)` over transactions with `cost > cashback`.
2. `x = max` of `cashback` over losing transactions and of `cost` over the others.
3. Return `loss + x`.

Examples → 10, 3. Checked against the worst of every order on 300 random small cases.

Before the last losing transaction t, money has dropped by every other loss, and paying t needs its cost, so the need is `loss − (cost − cashback) + cost = loss + cashback`. A non-losing transaction is worst after every loss, needing `loss + cost`. Totals reach 10^14, so use 64-bit.

Time: O(n)  
Space: O(1)

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
