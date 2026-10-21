## Count matching prefixes

`count = {0: 1}`, `s = 0`, `ans = 0`. For each `x`:

1. `s += x`.
2. `ans += count.get(s − goal, 0)`.
3. `count[s] += 1`.

Return `ans`.

Since values are 0 or 1, the prefix sums are at most `n`, so an array works instead of a map.

A sliding-window alternative: `atMost(goal) − atMost(goal − 1)`, where `atMost(g)` counts subarrays with sum ≤ g using two pointers. It is O(1) extra space.

Do not use a single sliding window for "exactly goal"; zeros make the window boundaries ambiguous. Do not forget `count[0] = 1` for subarrays starting at index 0.

Time: O(n)  
Space: O(n)

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
