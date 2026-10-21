## Enumerate the middle edge

1. `top[v]` = up to 3 neighbours of `v` with the highest scores.
2. For each edge `(b, c)`: for `a` in `top[b]`, `d` in `top[c]`: if `a, b, c, d` are distinct, update the best `score[a] + score[b] + score[c] + score[d]`.
3. Return the best, or −1.

Examples → 24, −1. Checked against every 4-node path on 200 small graphs.

Three candidates suffice: one can collide with `c` and one with the choice for `d`, leaving at least one valid. That makes the work 9 checks per edge.

Time: O(E log E)  
Space: O(n + E)

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
