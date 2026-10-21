## Sizes first, then cut

1. Count `n`. Let `base = n // k`, `extra = n % k`.
2. For part `i` in `0 … k − 1`: its size is `base + (1 if i < extra else 0)`. Record the current node as the part's head, walk `size − 1` more nodes, then cut: save `next`, set `tail.next = null`, and continue from `next`.
3. A part of size 0 is `null`, which happens when `k > n`.

The earlier parts must be at least as long as the later ones, and sizes may differ by at most 1, which is exactly what `base` and `extra` give.

Do not give the extra nodes to the last parts; the earlier ones must be longer. Do not forget to cut each part's tail, or every part keeps the rest of the list.

Time: O(n + k)  
Space: O(k) for the output

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
