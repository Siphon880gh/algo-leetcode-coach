## Flip the problem

1. `target = sum(nums) − x`; if negative, return −1.
2. Sliding window: grow `r`, shrink `l` while the sum exceeds `target`; when equal, record the length.
3. Return `n − best`, or −1 if no window was found.

`[1,1,4,2,3]`, 5 → 2. `[5,6,7,8,9]`, 4 → −1. `[3,2,20,1,1,3]`, 10 → 5.

`target = 0` gives an empty window (remove everything), which the loop handles as best = 0. Positivity is what makes the window valid.

Time: O(n)  
Space: O(1)

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
