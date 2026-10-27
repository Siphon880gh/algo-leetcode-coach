## Example first

edges = [[3, 1], [3, 2], [1, 4], [2, 0]], colors = "BRRWB".

1. Node 3 is W. Its neighbours 1 and 2 are R. Their neighbours 4 and 0 are B.
2. Rooted at 3, depth 0 is W, depth 1 is R, depth 2 is B: the cycle W, R, B.
3. Every node has at most two children. Answer 3.

## Idea

All three allowed sequences are the same cycle W → R → B → W started at different colors. Number W = 0, R = 1, B = 2: a child's color is (parent + 1) mod 3. So an edge with two different colors already says which end is the parent. An edge with equal colors can never work.

## Steps

1. For each node u with color c, count its neighbours of color c and of color c − 1 (mod 3).
2. Any neighbour of color c means −1.
3. More than one neighbour of color c − 1 means two parents: −1.
4. The root is a node with no neighbour of color c − 1. It also needs at most two neighbours, since all of them become children. Every other node has one parent and at most two children, because degrees are at most 3.
5. Return that node, or −1.

## Trap

Forgetting the root's child limit. A star with node 0 colored R and three B neighbours passes the color checks, but node 0 would have three children. That gives 0 instead of −1. Fix: the root must have degree ≤ 2.

Checked: the examples give 3 and −1, and the checks matched rooting at every node and testing the rules on 300 random trees.

Time: O(n)  
Space: O(n)

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
