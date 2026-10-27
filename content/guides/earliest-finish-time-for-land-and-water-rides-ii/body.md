## Two scans

1. F_land = min(ls[i] + ld[i]); a = min over j of max(F_land, ws[j]) + wd[j].
2. F_water = min(ws[j] + wd[j]); b = min over i of max(F_water, ls[i]) + ld[i].
3. Answer min(a, b).

Examples → 9, 14. Checked against trying every pair on 2,000 random cases.

Taking the ride that opens first instead of the one that finishes first: land [1, 2] with durations [10, 1], water [5] with duration [10] → 16 instead of 15.

Time: O(n + m)  
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
