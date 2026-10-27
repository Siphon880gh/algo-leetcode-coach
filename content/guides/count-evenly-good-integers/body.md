You get two integers l and r with 1 ≤ l ≤ r ≤ 10^15. An integer is evenly good when it has an even number of even digits (0, 2, 4, 6, 8); having none counts as even. Return how many evenly good integers lie in [l, r]. Example: l = 18, r = 22 gives 3, namely 19, 20 and 22. _(Restated in my own words; the full statement shows when premium is unlocked.)_

## Example first

l = 18, r = 22.

| Number | Even digits | Good |
|--------|-------------|------|
| 18 | 8 | no |
| 19 | none | yes |
| 20 | 2, 0 | yes |
| 21 | 2 | no |
| 22 | 2, 2 | yes |

Answer 3.

## Idea

r reaches 10^15, so count instead of listing. Let F(x) = how many good numbers lie in [1, x]. The answer is F(r) − F(l − 1). F comes from a digit DP that fills digits from the top.

## Steps

1. Write x as a digit string.
2. dfs(pos, parity, tight, started) tries every digit d up to x's digit when tight, else up to 9.
3. A digit counts as even only once the number has started (d > 0 or started is already true). Leading zeros are not digits of the number.
4. At the end, count 1 when started is true and parity is even.
5. Memoize on (pos, parity, started) for the non-tight states.

## Trap

Padding numbers with leading zeros and counting those zeros as even digits. 7 written as 07 would have one even digit and look bad. For [1, 10] that gives 4 instead of 5. Fix: only count digits after the number starts.

Checked: the examples give 3, 2 and 5, and the DP matched checking every number on 300 random ranges.

Time: O(D · 2 · 2 · 10) with D ≤ 16 digits  
Space: O(D)

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
