## Tiny example

The prices are `[1, 2, 4]`. You may hold at most one share at a time, and you want the most profit.

After each day, keep two running values:

- **cash**: the best profit so far with no share in hand.
- **hold**: the best profit so far while holding a share. This is usually negative right after you buy.

Before the first day, `cash = 0` and `hold = −∞`, because you cannot hold a share yet.

| After price | cash | hold |
|-------------|------|------|
| 1 | 0 | −1 (buy) |
| 2 | 1 (sell) | −1 |
| 4 | **3** (sell) | −1 |

The final answer is the cash value, **3**: buy at 1 and sell at 4.

Variants with a cooldown or a fee only change the update rules. For example, with a cooldown, cash is updated from an older day.

## How

1. Name the states in words: cash, hold, and possibly cooldown.
2. Write how each state updates from the previous day.
3. Walk through the prices once.
4. Return the "no share" state at the end.

## Trap

Writing updates that let you buy and sell freely on the same day when the problem forbids overlapping trades.

**Fix:** Update hold only from cash minus the price, and cash only from hold plus the price, plus any cooldown rule.

**Time:** O(n) · **Space:** O(1) for the classic two-state version

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
