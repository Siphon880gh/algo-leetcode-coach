## Bit-by-bit greedy

1. mask = 0. For b = 29 down to 0: m = mask | 2^b.
2. Scan with cur = all ones: cur &= x; if cur & m ≠ 0, count one merge; else close the group (cur = all ones).
3. If merges ≤ k, mask = m. Return the complement of mask within 30 bits.

Examples → 3, 2, 15. Checked against trying every way to merge on 800 random small arrays.

Closing a group as soon as it works is optimal: a longer group only has a smaller AND, and closing early leaves more elements for later groups. Higher bits are worth more than all lower bits together, so each is decided first.

Time: O(30 n)  
Space: O(1)

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
