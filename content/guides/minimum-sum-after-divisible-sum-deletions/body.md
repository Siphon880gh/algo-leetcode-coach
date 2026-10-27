## One pass

1. best[0] = 0; f = 0; p = 0.
2. For each x: p = (p + x) mod k; f = min(f + x, best[p]); best[p] = min(best[p], f).
3. Return f.

Examples → 1, 5. Checked against trying every sequence of deletions on 800 random arrays.

Allowing only one deletion: [5, 3, 4, 1], k = 5 → 8 instead of 3.

Time: O(n)  
Space: O(min(n, k))

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
