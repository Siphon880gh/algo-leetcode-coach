## Split by parity

The rule: no `i < k < j` with `2 · nums[k] = nums[i] + nums[j]`.

Key facts:

- An affine map `x → 2x − 1` or `x → 2x` keeps an array beautiful.
- If `nums[i]` is odd and `nums[j]` is even, their sum is odd, so it cannot equal `2 · nums[k]`.

So:

- `f(1) = [1]`.
- `f(n) = [2x − 1 for x in f((n + 1) // 2)] + [2x for x in f(n // 2)]`.

The first half holds the odd numbers `1 … n` and the second half the even ones. Memoize by `n`.

Do not search permutations; n is up to 1000. Do not mix odds and evens within one half.

Time: O(n log n)  
Space: O(n log n) with memo, O(n) for the result

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
