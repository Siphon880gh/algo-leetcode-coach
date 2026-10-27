## Small state space, search it

The state is the board (after all cascades) plus the multiset of balls left in hand. BFS from `(board, hand)` finds the fewest insertions: the first time the board is empty, the number of balls used is the answer. Store the hand sorted so the same multiset is one state, and keep a visited set.

**Collapse.** After an insert, repeatedly find a run of length ≥ 3 and remove it until none is left (a regex loop or a stack-based scan).

**Pruning inserts.** Inserting ball `c` at position `i` is only worth trying if `board[i] == c` (extend a group), or if `board[i − 1] == board[i] != c` (split a pair so that later moves can use it). Inserting `c` right after a `c` is the same as before it, so skip duplicates. Without the second rule, the search misses answers where a ball of another color is pushed between a pair first, so the pair can later merge into a run of 3 after a cascade.

Memoized DFS on `(board, hand)` returning the minimum works the same way.

Candy Crush (723) collapses a grid without choices. Remove Boxes (546) is a different interval DP.

Do not only insert next to a ball of the same color — that misses the split case. Do not collapse only once; cascades must repeat.

Time: exponential in hand size, small because |hand| ≤ 5 and |board| ≤ 16  
Space: number of visited states

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
