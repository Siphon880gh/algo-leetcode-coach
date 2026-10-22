## One digit or two

1. If the arrays share digits, return the smallest shared one.
2. Else `a = min(nums1)`, `b = min(nums2)`; return `10 · min(a, b) + max(a, b)`.

Examples → 15, 3. Checked against scanning 1 … 99 on 300 random digit sets.

Digits are 1 … 9, so there is no leading-zero case.

Time: O(n + m)  
Space: O(1) with a 10-entry table

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
