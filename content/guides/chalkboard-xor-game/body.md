## The parity argument

A player who starts a turn with XOR 0 wins. Otherwise they must erase a number, and they lose if the remaining XOR becomes 0.

Suppose Alice faces an even count `n` with XOR `X ≠ 0`. If every choice lost, then for each `i`, `X ^ nums[i] == 0`, so every `nums[i] == X`. But an even number of copies of `X` XORs to 0, a contradiction. So she always has a safe move, which leaves Bob an odd count; Bob then hands her an even count again. The game ends with Alice winning.

So return `xor(nums) == 0 or len(nums) % 2 == 0`.

Do not search the game tree; it is exponential. Do not forget the XOR-0 start; then Alice wins even with an odd count.

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
