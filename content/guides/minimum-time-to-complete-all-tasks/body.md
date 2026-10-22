## Latest seconds first

1. Sort `tasks` by end; `on[t] = false` for every second.
2. For each `[s, e, d]`: `d −= ` the number of on seconds in `[s, e]`.
3. Walk `t` from `e` down while `d > 0`: if `on[t]` is false, set it and `d−−`.
4. Return the number of on seconds.

Examples → 2, 4. Checked against trying every set of seconds on 200 random small cases.

Any later task ends at or after e, so a second near e is at least as useful to it as an earlier one. Times are at most 2000, so a plain array works.

Time: O(n log n + n · T) for T = 2000  
Space: O(T)

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
