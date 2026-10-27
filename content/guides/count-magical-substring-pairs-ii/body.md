## Example first

s = "cab".

1. Split after "c": left "c" (1 distinct). Right "a" (1) and "ab" (2). 1 pair.
2. Split after "a": left "a" (1) and "ca" (2). Right "b" (1). 1 pair.

Answer 2.

## Idea

For a fixed end j, extending a substring to the left never lowers its distinct count. So:

substrings ending at j with exactly d letters = (longest suffix with at most d letters) − (longest with at most d − 1)

For each d from 1 to 26, one sliding window gives the "at most d" length for every end.

## Steps

1. L[j][d] = length of the longest substring ending at j with at most d distinct letters, from 26 sliding windows.
2. R[j][d] = the same for substrings starting at j, from the reversed string.
3. Answer = sum over splits j and d of (L[j][d] − L[j][d − 1]) · (R[j + 1][d] − R[j + 1][d − 1]).

Use 64-bit counts.

## Trap

Using an "at most d" count on one side. It also counts substrings with fewer letters, so "cab" gives 3 instead of 2. Fix: subtract to get exact counts on both sides.

Checked: the examples give 2, 4 and 7, and the method matched checking every triple on 300 random strings.

Time: O(26 · n)  
Space: O(26 · n)

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
