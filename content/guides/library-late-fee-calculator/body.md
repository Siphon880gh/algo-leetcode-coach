Each book was returned some number of days late. The fee for a book depends on which band its lateness falls into, with a different rule per band (the bands and rates are in the official statement). Return the total fee over all books. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Per book

1. total = 0.
2. For each d in daysLate: total += fee(d), where fee applies the rule of the band d falls into.
3. Return total.

Constructed check (run in code, with made-up bands: up to 3 days costs 1 per day, more costs 2 per day): [2, 5] → 2 + 10 = 12.

Adding the days first and pricing the total once, with the same bands: [2, 5] → 7 days → 14 instead of 12.

Time: O(n)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
