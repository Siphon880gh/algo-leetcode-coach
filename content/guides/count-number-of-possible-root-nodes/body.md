## Rerooting

1. Put the guesses in a hash set of pairs.
2. Root at 0 and count guesses `(parent, child)` that match: `cnt[0]`.
3. From the root down, for each child `v` of `u`: `cnt[v] = cnt[u] − [(u, v) guessed] + [(v, u) guessed]`.
4. Return the number of nodes with `cnt ≥ k`.

Examples → 3, 5. Checked against rooting at every node on 300 random trees.

Only the edge u–v flips direction when the root moves across it; every other parent stays the same. Use an iterative traversal, since a path of 10^5 nodes would overflow a recursive one.

Time: O(n + g)  
Space: O(n + g)

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
