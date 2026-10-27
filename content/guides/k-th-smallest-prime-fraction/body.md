## Count below a real threshold

`count(x)`: for each denominator index `j`, numerators `arr[i]` with `arr[i] ≤ x · arr[j]` form a prefix. Move one pointer `i` forward as `j` grows (the prefix only grows). Track the largest fraction `p / q` among those counted.

Binary search `x` in `(0, 1)`: if `count(x) == k`, return `[p, q]`; if it is less than `k`, raise `lo`; otherwise lower `hi`. Fractions are distinct, so an exact count is always reached.

**Heap alternative:** push `arr[0] / arr[j]` for every `j`, pop `k − 1` times, each time pushing the next numerator for the same denominator. That is O(k log n), slower for large `k`.

Do not list all fractions and sort; that is O(n² log n). Do not compare fractions with floats when exactness matters; cross-multiply instead.

Time: O(n · log(1 / ε))  
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
