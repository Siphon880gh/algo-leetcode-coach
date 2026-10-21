## Count below a guess

Row `i` holds `i, 2i, …, n·i`, so it has `min(x // i, n)` entries that are `≤ x`. Summing over the rows gives `count(x)` in O(m).

Binary search `x` in `[1, m · n]`: if `count(mid) ≥ k`, set `hi = mid`, else `lo = mid + 1`. The final `lo` is the answer, and it is always an actual table entry, because `count` only increases at table values.

Iterating over the shorter side keeps the count at O(min(m, n)).

Do not build or sort the table; it can have 9 · 10⁸ entries. Do not stop at the first `mid` with `count(mid) == k`; it may not be in the table. Keep narrowing to the smallest such value.

Time: O(m · log(m · n))  
Space: O(1)

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
