## Tiny example

Prices `[1, 2, 4]`. At most one share at a time. Maximize profit.

Keep two running values after each day:

- **cash** = best profit with no share in hand
- **hold** = best profit while holding a share (usually negative after buying)

Start before day 0: `cash = 0`, `hold = −∞` (impossible to hold yet).

| After price | cash | hold |
|-------------|------|------|
| 1 | 0 | −1 (buy) |
| 2 | 1 (sell) | −1 |
| 4 | **3** (sell) | −1 |

Final answer = cash = **3** (bought at 1, sold at 4).

Cooldown / fee variants only change the transitions (for example cash updates from an older day).

## How

1. Name states in words (cash vs hold, maybe cooldown)
2. Write how each state updates from yesterday
3. Walk the price array once
4. Answer the “no share” state at the end

## Trap

Encoding “buy and sell same day freely” when the problem forbids overlapping trades.

**Fix:** hold only updates from cash−price; cash only from hold+price (plus any cooldown rule).

**Time:** O(n) · **Space:** O(1) for the classic two-state form

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
