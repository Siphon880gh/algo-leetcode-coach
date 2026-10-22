This is the harder version of Count Houses in a Circular Street. You again walk an interactive circular street with an upper bound k on the number of houses and must return how many houses there are, but your control over the doors is more limited than in the first version. The exact operations, the guarantee about which doors start open, and the limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Close and check

This method assumes, as in the usual version, that you can close but not open doors and that at least one door starts open; adapt it if the statement says otherwise.

1. Move right until the current door is open; call it the start.
2. Walk right, counting steps c. At an open door: close it, walk back c steps, and if the start’s door is closed, return c; otherwise walk forward c steps again.
3. Keep going; within k steps you return to the start.

Constructed checks (simulated in code): doors closed, open, closed, open, open → 5; one open house → 1; four open doors → 4; 500 random streets → their size.

Stopping at the next open door finds a neighbour, not the start: the first street → 2 instead of 5.

Time: O(k²) moves in the worst case  
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
