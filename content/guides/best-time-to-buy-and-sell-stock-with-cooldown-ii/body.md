You get prices[0 … n − 1], a cooldown, and costs[0 … n − 1], where costs[d] is a one-time fee for a trade that holds the share for exactly d days. You hold at most one share. After selling on day j, the earliest next buy is day j + cooldown + 1. Buying on day i and selling on day j earns prices[j] − prices[i] − costs[j − i]. Return the best total profit, or 0 if nothing helps. Example: prices = [1, 5, 3], cooldown = 1, costs = [2, 0, 1] gives 4. n ≤ 1500. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

prices = [1, 5, 3], cooldown = 1, costs = [2, 0, 1].

| Buy | Sell | Profit |
|-----|------|--------|
| day 0 | day 1 | 5 − 1 − costs[1] = 4 |
| day 0 | day 2 | 3 − 1 − costs[2] = 1 |
| day 1 | day 2 | 3 − 5 − costs[1] = −2 |

After selling on day 1 the cooldown blocks day 2. Answer 4.

## Idea

The fee depends on how many days you hold, so a single "holding" state cannot know which fee to pay. Choose the buy day explicitly.

F[j] = the best profit with every trade closed by day j.

F[j] = max(F[j − 1], max over i < j of F[i − cooldown − 1] + prices[j] − prices[i] − costs[j − i])

F at a negative index is 0.

## Steps

1. For each sell day j, start from F[j − 1] (no sale on day j).
2. For each buy day i < j, add the best profit that allows buying on day i: F[i − cooldown − 1], or 0.
3. Return F[n − 1]. It is never below 0.

n ≤ 1500, so about 1.1 million pairs.

## Trap

Ignoring the cooldown. prices = [5, 9, 2, 5], cooldown = 1, costs all 0: selling on day 1 and buying on day 2 looks like 4 + 3 = 7, but day 2 is blocked. That gives 7 instead of 4. Fix: chain through F[i − cooldown − 1].

Checked: the four examples give 4, 3, 6 and 2, and the DP matched a full search over buy and sell days on 300 random cases.

Time: O(n²)  
Space: O(n)

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
