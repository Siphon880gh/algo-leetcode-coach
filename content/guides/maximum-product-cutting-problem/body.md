## Tiny example

Split the integer `n = 10` into parts of at least 1 so that the **product** of the parts is as large as possible.

Prefer parts close to **3**:

- `10 = 3 + 3 + 4` gives `3 · 3 · 4 = 36`.
- Splitting the 4 into `2 + 2` gives `3 · 3 · 2 · 2 = 36`. This is the same product, because 2 · 2 = 4.
- `10 = 3 + 3 + 3 + 1` gives only `27`. The part of 1 adds nothing to the product.

So the best product for 10 is **36**.

Rule of thumb: use as many 3s as possible. If the remainder is 1, replace `3 + 1` with `2 + 2`. A remainder of 2 is fine as it is.

## How

1. With the math shortcut, count the 3s and apply the remainder fix.
2. Or use DP, where `dp[i]` is the best product from splitting i.
3. Never leave a part of 1.

## Trap

Splitting into all 1s, or leaving a remainder of 1 (`3 + 1`).

**Fix:** When the remainder is 1, use `2 + 2` instead of `3 + 1`.

**Time:** O(1) with the math shortcut, or O(n²) with DP · **Space:** O(1) or O(n)

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
