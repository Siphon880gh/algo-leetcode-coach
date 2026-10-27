## Top set and rest set

1. To change v’s count: remove (f, v) from whichever set holds it (subtract f · v if top), update f, insert into rest.
2. Rebalance: while top has fewer than x or rest’s max beats top’s min, swap them, adjusting the sum.
3. After each full window, record the sum.

Examples → [6, 10, 12], [11, 15, 15, 15, 12]. Checked against recounting each window on 400 random cases.

Recounting each window: up to 10^5 · 5 · 10^4 = 5 · 10^9 steps. Sums reach 10^14; use 64-bit.

Time: O(n log n)  
Space: O(n)

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
