## Example first

nums = [3, 1, 7].

1. Bit 2: only 7 has it, so 7 goes first. power[12] = 1.
2. Bit 1: after 7, put 3 (it has bit 1) before 1. power[13] = 2.
3. Bit 0: all three have it. power[14] = 3.

Order [7, 3, 1], and every higher entry is 0.

## Blocks

Keep the numbers in an ordered list of blocks. Order inside a block is still free; the blocks themselves are fixed.

1. Start with one block holding every number.
2. For bit 14 down to bit 0, walk the blocks from the front.
3. While a block has the bit in every number, add its size and move on.
4. At the first block where some number lacks the bit, add how many do have it, split that block into [with the bit] then [without], and stop. The total is power for this bit.

Splitting keeps exactly the orders that reached every earlier maximum, so later bits never undo earlier ones.

## Trap

Sorting by value, largest first. For [2, 9, 1] that gives [9, 2, 1], so bit 0 has a prefix of 1. [9, 1, 2] keeps two numbers with bit 0, so the last entry should be 2. Fix: refine blocks per bit.

Checked: both examples match, and the blocks matched trying every permutation on 300 random small arrays.

Time: O(15 · n)  
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
