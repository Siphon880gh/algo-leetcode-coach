## Example first

n = 4. The good strings are "aaab", "abbb", "baaa", "bbba", "abab" and "baba".

1. "aaab" splits as "aaa" + "b": both are single letters with odd length, and a ≠ b at the seam.
2. "aabb" is not good: any split either cuts inside a run or leaves a run of even length.

## Rule

A split must put different letters on each side of the seam, so it always falls between two runs. So a string is good exactly when every run has odd length.

## Counting

1. Pick the first letter: 2 ways. The runs then alternate letters.
2. Count the ways to write n as a sum of odd parts in order. The last part is 1 (leaving n − 1), or at least 3 (shrink it by 2, leaving n − 2). So c(n) = c(n − 1) + c(n − 2) with c(1) = c(2) = 1: the Fibonacci numbers.
3. Answer = 2 · F(n) mod 10^9 + 7.

n reaches 10^15, so compute F(n) with fast doubling:

- F(2m) = F(m) · (2F(m + 1) − F(m))
- F(2m + 1) = F(m)² + F(m + 1)²

## Trap

Forgetting the two starting letters. n = 4 then gives 3 instead of 6. Fix: multiply by 2.

Checked: the examples give 6, 4 and 2, and the formula matched testing the recursive definition on every string for n ≤ 12.

Time: O(log n)  
Space: O(log n)

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
