## Count, then search

`L = lcm(a, b) = a · b / gcd(a, b)`.

`count(x) = x // a + x // b − x // L`.

`lo = min(a, b)`, `hi = n · min(a, b)` (the n-th multiple of the smaller one is magical). While `lo < hi`:

- `mid = (lo + hi) // 2`.
- If `count(mid) ≥ n`, `hi = mid`; else `lo = mid + 1`.

Return `lo % (10⁹ + 7)`.

The smallest `x` with `count(x) ≥ n` is itself magical, since the count only rises at magical numbers.

Do not take the modulus inside the search; the comparisons need the real values. Do not merge the two sequences one step at a time; n can be 10⁹.

Time: O(log(n · min(a, b)))  
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
