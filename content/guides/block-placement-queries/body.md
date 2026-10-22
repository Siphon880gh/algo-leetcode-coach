## Gaps at obstacles

1. Start with an obstacle at 0. Inserting x between p and q: tree[x] = x − p, tree[q] = q − x.
2. Query (x, sz): p = last obstacle ≤ x; true if max(tree[0 … x]) ≥ sz or x − p ≥ sz.

Examples → [false, true, true], [true, true, false]. Checked against testing every placement on 500 random query lists.

Forget the stretch after the last obstacle and [[2, 5, 3]] → false instead of true.

Time: O(q log q)  
Space: O(max x)

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
