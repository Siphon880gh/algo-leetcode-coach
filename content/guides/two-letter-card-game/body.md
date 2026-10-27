## Split the wildcards

1. A = counts of the second letter over cards "xc" (c ≠ x); B = counts of the first letter over cards "cx"; w = number of "xx" cards.
2. With total T cards on a side (j wildcards included) and largest class M (a letter or the wildcards), that side gives min(⌊T / 2⌋, T − M) pairs.
3. Return the best of side A with j wildcards plus side B with w − j, over j = 0 … w.

Examples → 2, 1, 0. Checked against a maximum matching found by search on 1,500 random decks.

Leaving out the "xx" cards: example 1 → 1 instead of 2.

Time: O(n + w · 10)  
Space: O(1) (letters a to j)

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
