## Count, align, compare

1. `ones = sum(arr)`. If `ones == 0`, return `[0, n − 1]`. If `ones % 3 != 0`, return `[−1, −1]`.
2. `t = ones / 3`. Let `a`, `b`, `c` be the indices of the 1st, (t + 1)-th and (2t + 1)-th 1.
3. The third part is `arr[c:]`, so each value has length `L = n − c`, trailing zeros included.
4. Check that `arr[a:a+L]`, `arr[b:b+L]` and `arr[c:]` are equal and that `a + L ≤ b` and `b + L ≤ c`. If not, return `[−1, −1]`.
5. Return `[a + L − 1, b + L]`.

Leading zeros do not change a binary value, so each part may start with zeros before its first 1; only the stretch from the first 1 onward must match.

Do not try all pairs of cut points; that is O(n²) comparisons of long numbers. Do not convert parts to integers; n can be 3·10⁴ bits.

Time: O(n)  
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
