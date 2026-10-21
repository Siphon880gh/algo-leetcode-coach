## Remainder pairs

`cnt = [0] * 60`, `ans = 0`. For each `t`:

1. `r = t % 60`.
2. `ans += cnt[(60 − r) % 60]`.
3. `cnt[r] += 1`.

Return `ans`.

`(60 − r) % 60` maps remainder 0 to 0, so two multiples of 60 pair with each other. Counting before recording ensures `i < j` and no song pairs with itself.

Do not check all pairs; that is O(n²) for n up to 6·10⁴. Do not use `60 − r` without the mod; remainder 0 would look for 60.

Time: O(n)  
Space: O(60)

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
