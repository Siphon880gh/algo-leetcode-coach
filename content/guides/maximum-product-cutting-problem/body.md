## Tiny example

Break integer `n=10` into summands ≥1 to **maximize product**.

Prefer parts near **3**:

1. `10 = 3+3+4` but `4=2+2` and `2·2=4 > 4` as a single part product? Wait: single 4 product is 4; `2+2` product 4 — equal. Prefer avoiding leftover 1s.
2. Better: `3+3+2+2` → product `3·3·2·2=36`

Rule of thumb: use as many 3s as possible; if remainder 1, replace `3+1` with `2+2`; remainder 2 is fine.


## How

1. If using the greedy math: count threes with the remainder fix
2. Or DP: `dp[i]=max product breaking i`
3. Never leave a part of 1


## Trap

Breaking into all 1s or leaving a remainder 1 (`3+1`).

**Fix:** Remainder 1 → use `2+2` instead of `3+1`.

**Time:** O(1) greedy math or O(n²) DP · **Space:** O(1) or O(n)

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
