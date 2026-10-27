## Stack

1. rem = letter counts still ahead; ins = counts in the stack.
2. For each c: rem[c]−−; while top > c and (rem[top] > 0 or ins[top] > 1), pop. Push c.
3. While ins[top] > 1, pop.
4. Return the stack.

Examples → "aacb", "z". Checked against trying every allowed subsequence on 2,500 random strings.

Keeping each letter exactly once (as in Remove Duplicate Letters): example 1 → "acb" instead of "aacb".

Time: O(n)  
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
