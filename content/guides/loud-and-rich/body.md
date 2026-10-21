## The answer flows down from the rich

Build `adj[b]` containing `a` for every pair `[a, b]` in `richer` (a is richer than b).

`dfs(x)`:

1. If `ans[x]` is set, return it.
2. Start with `best = x`.
3. For each richer `y` in `adj[x]`: `c = dfs(y)`; if `quiet[c] < quiet[best]`, set `best = c`.
4. Store and return `ans[x] = best`.

Call `dfs` for every person. The richness relation has no cycles, so the recursion ends.

Using `answer[y]` instead of `y` itself is what makes richness transitive: anyone richer than `y` is also richer than `x`.

Do not run a fresh search per person without memoization; that is O(n · (n + m)). Do not forget that `x` counts as at least as rich as itself.

Time: O(n + m)  
Space: O(n + m)

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
