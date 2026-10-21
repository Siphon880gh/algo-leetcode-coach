Given sorted positions of gas stations on a line and an integer `k`, add `k` new stations anywhere (not necessarily at integer positions) to minimize the largest distance between adjacent stations. Return that smallest possible maximum distance; answers within 10⁻⁶ are accepted. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Count stations needed for a guess

For each gap `g` between neighbors, keeping every piece at most `D` takes `ceil(g / D) − 1` new stations, placed evenly inside the gap.

`ok(D)`: total needed `≤ k`.

Binary search `D` in `[0, max gap]`: `mid = (lo + hi) / 2`; if `ok(mid)`, `hi = mid`, else `lo = mid`. Stop when `hi − lo < 1e-6` (or run a fixed 100 iterations) and return `hi`.

A max-heap that repeatedly splits the current largest gap is O(k log n) and too slow for `k` up to 10⁶.

Do not repeatedly halve the largest gap; a gap of 3 with 2 stations is best split into thirds, not halves. Do not binary search over integers; the answer is a real number.

Time: O(n · log(maxGap / 1e-6))  
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
