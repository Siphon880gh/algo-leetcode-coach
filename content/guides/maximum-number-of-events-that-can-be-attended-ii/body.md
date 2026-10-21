## Take or skip

1. Sort by start day; `starts` is the sorted list of starts.
2. `next[i] = bisect_right(starts, end[i])`; the end day is inclusive, so the next event must start strictly later.
3. `f(i, k) = max(f(i + 1, k), value[i] + f(next[i], k − 1))`, with `f(n, ·) = f(·, 0) = 0`.

Example 1 → 7, example 2 → 10, example 3 → 9.

Do not use `bisect_left`: an event starting on another's end day would be allowed. The `k · n ≤ 10^6` bound keeps the table small.

Time: O(n log n + n · k)  
Space: O(n · k)

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
