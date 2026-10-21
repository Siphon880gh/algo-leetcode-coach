## The difference is the state

`dp[d]` = the largest shorter-side height with taller − shorter = `d`. Start with `dp = {0: 0}`.

For each rod `r`, build `nd` from a copy of `dp` (skipping the rod), then for each `(d, s)` in `dp`:

- Put it on the taller side: `nd[d + r] = max(nd[d + r], s)`.
- Put it on the shorter side: the new difference is `|d − r|` and the new shorter side is `s + min(d, r)`: `nd[|d − r|] = max(…, s + min(d, r))`.

Set `dp = nd`. Return `dp[0]`.

When `r > d`, the old shorter side becomes the taller one, and the new shorter side is the old taller one, `s + d`; the `min` covers both cases.

The sum of rods is at most 5000, so there are at most 5001 differences.

Do not enumerate the 3ⁿ assignments; n is up to 20. Meet-in-the-middle also works, but the DP is simpler.

Time: O(n · S), S = sum of rods  
Space: O(S)

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
