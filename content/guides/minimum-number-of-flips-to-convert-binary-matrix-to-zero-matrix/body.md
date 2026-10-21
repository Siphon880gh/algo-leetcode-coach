## Small state space

1. Encode cell `(i, j)` as bit `i · n + j`.
2. Precompute each cell's flip mask (itself plus in-bounds neighbours).
3. BFS from the start mask; each move XORs one flip mask. Return the depth when reaching 0, or −1.

`[[0,0],[0,1]]` → 3. `[[0]]` → 0. `[[1,0,0],[1,0,0]]` → −1.

Do not search greedily; flips interact. Do not forget the starting state may already be 0.

Time: O(2^(m·n) · m · n)  
Space: O(2^(m·n))

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
