## Each element rules out one range

After rotating by `k`, the element at index `i` moves to `(i − k) mod n`. It scores when `(i − k) mod n ≥ v`.

So it fails when `(i − k) mod n` is in `[0, v − 1]`, which is `k` in `[i − v + 1, i]` taken mod `n`. If `v == 0`, it always scores.

For each element, add 1 on that cyclic range of a difference array (when the range wraps, split it into two pieces). Prefix sums give `bad[k]`, and the answer is the smallest `k` with the minimum `bad[k]`.

Do not simulate every rotation and recount; that is O(n²). Do not forget the wrap: when `i − v + 1 < 0`, the range covers `[i − v + 1 + n, n − 1]` and `[0, i]`.

Time: O(n)  
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
