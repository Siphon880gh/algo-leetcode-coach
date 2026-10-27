## Example first

nums = [125]. Each move adds or subtracts 2, so 125 stays odd. 123 and 127 are not palindromes. 121 is, and it is 4 away: 2 moves.

nums = [10, 12, 14, 16]. The even palindromes nearby are 8 and 22. 10, 12 and 14 go down to 8 (1, 2, 3 moves). 16 goes up to 22 (3 moves). Total 9.

## Steps

1. Build every palindrome up to about 10^10 from prefixes 1 … 99999: mirror each prefix with and without its last digit.
2. Split them into even and odd lists and sort both.
3. For each x, binary-search its parity's list for the nearest palindrome above and below.
4. Add (distance / 2) for each element. Elements are independent.

## Trap

Ignoring parity. 16 looks 5 away from 11, but 11 is odd and unreachable. Ignoring parity gives 7 instead of 9 on Example 1. Fix: only same-parity palindromes count.

Checked: the examples give 9, 2 and 2, and the lookup matched stepping by 2 until a palindrome on 300 random arrays.

Time: O(P log P + n log P) with P ≈ 2 × 10^5 palindromes  
Space: O(P)

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
