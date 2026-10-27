## In-degree minus out-degree

`score = [0] * (n + 1)`. For each `[a, b]`: `score[a] −= 1`, `score[b] += 1`.

Return the `i` with `score[i] == n − 1`, or −1.

A score of `n − 1` needs all `n − 1` others trusting `i` and `i` trusting nobody, which is exactly the definition.

With `n = 1` and no trust pairs, person 1 is the judge (score 0 = n − 1).

Do not check only in-degree; the judge must also trust nobody. Do not build an adjacency matrix; counts are enough.

Time: O(n + t)  
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
